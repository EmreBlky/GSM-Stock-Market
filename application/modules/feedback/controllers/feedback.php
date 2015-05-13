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
        $this->load->model('activity/activity_model', 'activity_model');
        $data_activity = array(
                                'activity' => 'Feedback',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
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
            
    function leave_buy_feedback($mid, $sid, $order_id)
    {
        $data['main'] = 'feedback';
        $data['base'] = $this->config->item('base_url');
        $data['mid'] = $mid;
        $data['sid'] = $sid;
        $data['order_id'] = $order_id;
        //$data['member'] = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->company_name;
        $this->load->view('buy-feedback', $data);
    }
    
    function leave_sell_feedback($mid, $sid, $order_id)
    {
        $data['main'] = 'feedback';
        $data['base'] = $this->config->item('base_url');
        $data['mid'] = $mid;
        $data['order_id'] = $order_id;
        $data['sid'] = $sid;
        //$data['member'] = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->company_name;
        $this->load->view('sell-feedback', $data);
    }
    
    function processFeedback($mid, $sid, $rateDesc, $rateComms, $rateShip, $rateCompany,$order_id,$ratetypeuser=0, $body, $type)
    {
        $data = array(                       
                    'member_id'             => $mid,
                    'feedback_member_id'    => $sid,
                    'feedback_score'        => $rateDesc+$rateComms+$rateShip+$rateCompany,
                    'comments'              => $this->characterReplace($body),
                    'communication'         => $rateComms,
                    'shipping'              => $rateShip,
                    'description'           => $rateDesc,
                    'company'               => $rateCompany,
                    'authorised'            => 'no',
                    'date'                  => date('d-m-Y'),
                    'time'                  => date('H:i:s'),
                    'datetime'              => date('Y-m-d H:i:s'),
                    'type'                  => $type
                );                    
          $this->feedback_model->_insert($data);
       
//        $this->load->model('marketplace/marketplace_model'); 
//        $make_offer=$this->marketplace_model->get_row('make_offer',array('id'=>$order_id));
//        $setfield='';
//        $user_id = $this->session->userdata('members_id');
//        if($user_id == $make_offer->buyer_id){
//            $setfield='buyer_history';
//            $datetimefield='buyer_feedback_datetime';
//        }else{
//            $setfield='seller_history';
//            $datetimefield='seller_feedback_datetime';
//        }
//        if($ratetypeuser==1 && !empty($setfield) && !empty($datetimefield)){
//            $this->load->model('marketplace/marketplace_model'); 
//            $this->marketplace_model->update('make_offer',array($datetimefield=>date('Y-m-d h:i:s'),$setfield=>1),array('id'=>$order_id));
//        }elseif($ratetypeuser==2 && !empty($setfield)){
//            $this->load->model('marketplace/marketplace_model'); 
//            $this->marketplace_model->update('make_offer',array($datetimefield=>date('Y-m-d h:i:s'),$setfield=>1),array('id'=>$order_id));
//        }
        
    }
    
    function overallScore($mid)
    {
       $feedback_score =  $this->feedback_model->_custom_query("SELECT SUM(feedback_score) AS total FROM feedback WHERE member_id = '".$mid."' AND authorised = 'yes'");
       $feedback_count =  $this->feedback_model->_custom_query("SELECT COUNT(*) AS count FROM feedback WHERE member_id = '".$mid."' AND authorised = 'yes'");
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
    
    function feedback_list($mid)
    {
        //$mid = $this->session->userdata('members_id');
        $feedback =  $this->feedback_model->_custom_query("SELECT COUNT(*) AS count FROM feedback WHERE member_id = '".$mid."' AND authorised = 'yes'");
        
        if($feedback[0]->count > 0){
            
            $data['feedback_count'] = $feedback[0]->count;
            $data['feed_list'] = $this->feedback_model->get_where_multiples('member_id', $mid, 'authorised', 'yes');
       
       } 
       else{
           $data['feedback_count'] = 0;
       }
        
        $this->load->view('feedback-list', $data);
    }
    
    function member_feedback($mid)
    {
       $data['mid'] = $mid;
       $this->load->view('member-feedback', $data);
    }
}