<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
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
        $data['search_emails'] = $this->search_model->search_email($category);
        $data['query'] = $this->input->post('search');
        $data['category'] = $category;
        $this->load->module('mailbox');
        $this->mailbox->results($data);
    }

    function addressbook()
    {
        $this->load->view('addressbook-search');
    }

    function addressbookSearch()
    {
        $data['search_addressbook'] = $this->search_model->search_addressbook();
        //$data['query'] = $this->input->post('search');
        $this->load->module('addressbook');
        $this->addressbook->results($data);

    }

    function user()
    {
        $data['main'] = 'search';
        $data['title'] = 'GSM - Search User';
        $data['page'] = 'user';

        $this->load->module('templates');
        $this->templates->page($data);
    }

    /*function company()
    {
        $data['main'] = 'search';
        $data['title'] = 'GSM - Search Company';
        $data['page'] = 'company';

        $this->load->module('templates');
        $this->templates->page($data);
    }*/

    function query($search_terms = '', $start = 0)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('q', 'required|xss_clean');

        if ($this->input->post('q')) {
            redirect('/search/query/' . $this->input->post('q'));
        }

        if ($search_terms) {
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

    public function getSortingString()
    {
        $sort = $this->input->get('sort', TRUE);
        switch ($sort) {
            case "new-user":
                return ", m.date DESC";
                break;
            case "last-online":
                return ", l.date DESC";
                break;
            case "high-rating":
                return ", rating DESC";
                break;
            /*default:
                return "c.business_sector_1";
                break;*/
        }
    }

    function company($start = 1)
    {
        $results_per_page = 20;
        $start = ($start * $results_per_page) - $results_per_page;

        if($this->session->userdata('membership') < 2) {
            redirect('preferences/notice');
        }
        $data['main'] = 'search';
        $data['title'] = 'GSM - Search Company';
        $data['page'] = 'company';

        $where = " m.id <> " . $this->session->userdata('members_id');

        $term = $this->input->get('term', TRUE);
        $where .= (!empty($term)) ? " AND c.company_name LIKE '%$term%'" : '';

        $business = $this->input->get('business', TRUE);
        $where .= (!empty($business)) ? " AND (c.business_sector_1 LIKE '$business' OR c.business_sector_2 LIKE '$business' OR c.business_sector_3 LIKE '$business' OR other_business LIKE '%$business%')" : '';

        $region = $this->input->get('region', TRUE);
        $where .= (!empty($region)) ? " AND cnt.region LIKE '$region' " : '';

        $continent = $this->input->get('continent', TRUE);
        $where .= (!empty($continent)) ? " AND cnt.continent LIKE '$continent'" : '';

        $countries = $this->input->get('countries', TRUE);
        $where .= (!empty($countries)) ? " AND cnt.id = '$countries'" : '';

        $sort = $this->getSortingString();


        //$results_per_page = $this->config->item('results_per_page');


        $this->load->model('search_model');
        $this->load->model('country/country_model', 'country_model');
        $this->load->library('pagination');

        $results = $this->search_model->searchCompanies($where, $business, $sort, $start, $results_per_page);
        $total_results = $this->search_model->companiesCount($where);

        $this->pagination->initialize(array(
            'base_url' => site_url('/search/company/'),
            'uri_segment' => 3,
            'num_links' => 5,
            'use_page_numbers' => TRUE,
            'cur_tag_open' => '&nbsp;<a class="current">',
            'cur_tag_close' => '</a>',
            'next_link' => 'Next',
            'prev_link' => 'Prev',
            'last_link' => 'Last',
            'first_link' => 'First',
            'suffix'=> '?'.$_SERVER['QUERY_STRING'],
            'total_rows' => $total_results,
            'per_page' => $results_per_page
        ));

        $data['pagination'] = $this->pagination->create_links();
        $first_result = $start + 1;
        $last_result = min($start + $results_per_page, $total_results);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        $data['first_result'] = $first_result;
        $data['last_result'] = $last_result;
        $data['total_results'] = $total_results;
        $data['results'] = $results;
        $data['country'] = $this->country_model->_custom_query("SELECT id, country, continent, region FROM country GROUP BY country ORDER BY country ASC");
        $data['continents'] = $this->country_model->_custom_query("SELECT continent FROM country GROUP BY continent ORDER BY continent ASC");
        $data['regions'] = $this->country_model->_custom_query("SELECT region, continent FROM country GROUP BY region ORDER BY region ASC");

        $this->load->module('templates');
        $this->templates->page($data);

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

        if (empty($q)) {
            $data = array(
                'key_word' => $query
            );
            $this->load->model('search_model', 'search_model');
            $this->search_model->_insert($data);

        } else {

            $new_count = $q->count + 1;

            $data = array(
                'count' => $new_count
            );

            $this->load->model('search_model', 'search_model');
            $this->search_model->_update($q->id, $data);

        }
    }

}