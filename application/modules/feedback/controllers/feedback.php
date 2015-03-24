<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        $this->load->model('feedback/feedback_model', 'feedback_model');
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
    }

    function index()
    {
        $data['main'] = 'feedback';
	$data['title'] = 'feedback';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
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
    
    function admin_feed_count()
    {
        $f_count = $this->feedback_model->count_where('authorised', 'no');
        
        if($f_count > 0){
            echo '<span class="label label-warning pull-right">'.$f_count.'</span>';
        }
    }
            
    function leave_feedback($mid)
    {
        $data['main'] = 'feedback';
        $data['base'] = $this->config->item('base_url');
        //$data['member'] = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->company_name;
        $this->load->view('leave-feedback', $data);
    }
    
    function processFeedback($mid, $sid, $rateDesc, $rateComms, $rateShip, $rateCompany, $body)
    {
        $data = array(                       
                    'member_id' => $mid,
                    'feedback_member_id' => $sid,
                    'feedback_score' => $rateDesc+$rateComms+$rateShip+$rateCompany,
                    'comments' => $this->characterReplace($body),
                    'communication' => $rateComms,
                    'shipping' => $rateShip,
                    'description' => $rateDesc,
                    'company' => $rateCompany,
                    'authorised' => 'no',
                    'date' => date('d-m-Y'),
                    'time' => date('H:i:s'),
                    'datetime' => date('Y-m-d H:i:s')
                );                    
        $this->feedback_model->_insert($data);
        
    }
    
    function overallScore($mid)
    {
       $feedback_score =  $this->feedback_model->_custom_query("SELECT SUM(feedback_score) AS total FROM feedback WHERE member_id = '".$mid."'");
       $feedback_count =  $this->feedback_model->_custom_query("SELECT COUNT(*) AS count FROM feedback WHERE member_id = '".$mid."'");
       //echo '<pre>';
       //print_r($feedback_count);
       //echo $feedback_score[0]->total.'<br/>';
       //echo $feedback_count[0]->count.'<br/>';
       if($feedback_count[0]->count > 0){
       
       $overall = $feedback_score[0]->total/($feedback_count[0]->count*20)*100;
       
       } 
       else{
           $overall = 0;
       }
       
       return $overall;
       
    }
}