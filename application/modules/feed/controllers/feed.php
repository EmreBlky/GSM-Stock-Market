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
        $data_activity = array(
                                'activity' => 'Feed',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
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
    
    function characterReplace($var)
    {
        $var = str_replace('%20', ' ', $var);        
        $var = str_replace('BREAK1', '<br/>', $var);
        $var = str_replace('%22', '"', $var);
        $var = str_replace('%3C', '<', $var);
        $var = str_replace('%3E', '>', $var);
        $var = str_replace('%C2%B1', '±', $var);
        $var = str_replace('%7C', '|', $var);
        $var = str_replace('%7B', '{', $var);
        $var = str_replace('%7D', '}', $var);
        $var = str_replace('%5E', '^', $var);
        $var = str_replace('%C2%A3', '£', $var);
        $var = str_replace('%60', '`', $var);
        $var = str_replace('%C2%A7', '§', $var);
        $var = str_replace('QUEST1', '?', $var);
        $var = str_replace('SLASH1', '/', $var);
        $var = str_replace('PERCENT1', '%', $var);
        
        return $var;
    }
    
    function add($content)
    {
         
        $data = array(
                        'member_id'     => $this->session->userdata('members_id'),
                        'content'       => $this->characterReplace($content),
                        'date'          => date('d-m-Y'),
                        'time'          => date('H:i:s'),
                        'datetime'      => date('Y-m-d H:i:s')
                    );
        $this->feed_model->_insert($data);
        
    }
    
    function admin_feed_count()
    {
        $f_count = $this->feed_model->count_where('approved', 'awaiting_approval');
        
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