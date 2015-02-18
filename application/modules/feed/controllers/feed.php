<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
//        if ( ! $this->session->userdata('logged_in'))
//        { 
//            redirect('login');
//        }
        $this->load->model('feed/feed_model', 'feed_model');
    }

    function index()
    {
        redirect('home');
//        $data['main'] = 'feed';
//	$data['title'] = 'feed';
//        $data['page'] = 'index';
//        $this->load->module('templates');
//        $this->templates->page($data);
    }
    function add($content)
    {
         $content = str_replace('%20', ' ', $content);
         $content = str_replace('%0D%0A', '<br/>', $content);
         
         $data = array(
                        'member_id'     => $this->session->userdata('members_id'),
                        'content'       => $content,
                        'date'          => date('d-m-Y'),
                        'time'          => date('H:i:s'),
                        'datetime'      => date('Y-m-d H:i:s')
                    );
        $this->feed_model->_insert($data);
        
    }
    
    function admin_feed_count()
    {
        $f_count = $feed_count = $this->feed_model->count_where('approved', 'awaiting_approval');
        
        if($f_count > 0){
            echo '<span class="label label-warning pull-right">'.$f_count.'</span>';
        }
    }
    
    function feed_list($mid = NULL)
    {
        if(isset($mid)){
            
            $feed_count = $this->feed_model->count_where('member_id', $mid, 'approved', 'yes');
        
            if($feed_count > 0){
                $data['feed_count'] =  $feed_count;   
                $data['feed'] = $this->feed_model->get_where_multiples_order('datetime', 'DESC', 'member_id', $mid, 'approved', 'yes', NULL, NULL, NULL, NULL, 10, NULL);
            }
            else{
                $data['feed_count'] = 0;
                $data['feed_message'] = 'There are no Feeds at present.';
            }
            
        }
        else{
            
            $feed_count = $this->feed_model->count_where('member_id', $this->session->userdata('members_id'), 'approved', 'yes');
        
            if($feed_count > 0){
                $data['feed_count'] =  $feed_count;   
                $data['feed'] = $this->feed_model->get_where_multiples_order('datetime', 'DESC', 'member_id', $this->session->userdata('members_id'), NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL);
            }
            else{
                $data['feed_count'] = 0;
                $data['feed_message'] = 'You have no Feeds at present.';
            }
            
        }
        $this->load->view('feed-list', $data);
    }
    
    function post_feed()
    {
        $this->load->view('post-feed');
    }
}