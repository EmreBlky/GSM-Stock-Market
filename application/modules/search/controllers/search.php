<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        $this->load->model('search_model');
    }

    function index()
    {
        $data['main'] = 'search';        
        $data['title'] = 'GSM - Search';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function email($var)
    {
        $data['category'] = $var;
        $this->load->view('email-search', $data);
    }
    
    function emailSearch($category)
    {
        
        //echo $category;
        //echo '<pre>';
        //print_r($_POST);
        
        $test = $this->search_model->search_email($category);
        //return $test;
        echo '<pre>';
        print_r($test);
    }
            
    function user()
    {
        $data['main'] = 'search';        
        $data['title'] = 'GSM - Search User';        
        $data['page'] = 'user';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function company()
    {
        $data['main'] = 'search';        
        $data['title'] = 'GSM - Search Company';        
        $data['page'] = 'company';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function query($search_terms = '', $start = 0)
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('q', 'required|xss_clean');
        
        if ($this->input->post('q'))
        {
            redirect('/search/query/' . $this->input->post('q'));
        }
        
        if ($search_terms)
        {
            // Determine the number of results to display per page
            $results_per_page = $this->config->item('results_per_page');

            // Mark the start of search
            $this->benchmark->mark('search_start');

            // Load the model, perform the search and establish the total
            // number of results
            $this->load->model('search_model');
            $results = $this->search_model->search($search_terms, $start, $results_per_page);
            $total_results = $this->search_model->count_search_results($search_terms);

            // Mark the end of search
            $this->benchmark->mark('search_end');

            // Call a method to setup pagination
            $this->_setup_pagination('/search/query/' . $search_terms . '/', $total_results, $results_per_page);

            // Work out which results are being displayed
            $first_result = $start + 1;
            $last_result = min($start + $results_per_page, $total_results);
        }

        $data['search_query'] = $search_terms;
        $data['search_terms'] = $search_terms;
        $data['first_result'] = $first_result;
        $data['last_result'] = $last_result;
        $data['total_results'] = $total_results;
        $data['results'] = $results;        

        $this->load->module('templates');
        $this->templates->search($data);

        
    }
    
    function _setup_pagination($url, $total_results, $results_per_page)
    {
            // Ensure the pagination library is loaded
            $this->load->library('pagination');

            // This is messy. I'm not sure why the pagination class can't work
            // this out itself...
            $uri_segment = count(explode('/', $url));

            // Initialise the pagination class, passing in some minimum parameters
            $this->pagination->initialize(array(
                    'base_url' => site_url($url),
                    'uri_segment' => 4,
                    'total_rows' => $total_results,
                    'per_page' => $results_per_page
            ));
    }
    
    function insert_query($query)
    {
        $this->load->model('search_model');
        $q = $this->get_where_multiple('key_word', $query);
        
//        echo '';
//        print_r($q);
//        exit;
        
        if (empty($q))
        {
             $data = array(
                            'key_word' => $query
                         );
            $this->load->model('search_model', 'search_model');
            $this->search_model->_insert($data);
            
        }
        else{
            
            $new_count = $q->count+1;
            
            $data = array(
                          'count' => $new_count  
                         );
            
            $this->load->model('search_model', 'search_model');
            $this->search_model->_update($q->id, $data);        
            
        }
    }
    	
}