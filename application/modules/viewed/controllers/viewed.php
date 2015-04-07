<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewed extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        $this->load->model('activity/activity_model', 'activity_model');
        $this->load->model('viewed/viewed_model', 'viewed_model');
        $data_activity = array(
                                'activity' => 'Viewed',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
    }

    function index()
    {
        $data['main'] = 'viewed';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function view_day()
    {
        $count = $this->viewed_model->_custom_query_count("SELECT COUNT(*) AS viewed FROM viewed WHERE viewed_id = '".$this->session->userdata('members_id')."' AND date = '".date('d-m-Y')."'");
        
        if($count[0]->viewed > 0){
            
            //$data['views_count'] = $count[0]->viewed;
            //$data['views'] = '
            echo  '      
              <div class="ibox-content" style="min-height:89px">
                <h1 class="no-margins">'.$count[0]->viewed.'</h1>
                <!-- <div class="stat-percent font-bold">0%
                <i class="fa fa-level-up"></i>
                </div> -->
                <small>New visits</small>
              </div>';            
        }
        else{
           echo 
                '<div class="ibox-content" style="min-height:89px">
                    <h1 class="no-margins">No Views Today</h1>
                    <div class="stat-percent font-bold">
                    <!-- <i class="fa fa-level-up"></i> -->
                    </div>
                    <small>&nbsp;</small>
                </div>';
        }
        
    }
    
    function view_month()
    {
        $start_date = date('Y-m-d H:i:s', strtotime('-30 days'));

        $end_date = date('Y-m-d H:i:s');

        $count = $this->viewed_model->_custom_query_count("SELECT COUNT(*) AS viewed FROM viewed WHERE viewed_id = '".$this->session->userdata('members_id')."' AND record_date BETWEEN '".$start_date."' AND '".$end_date."'");
        
        if($count[0]->viewed > 0){
            
            //$data['views_count'] = $count[0]->viewed;
            //$data['views'] = '
            echo  '      
              <div class="ibox-content" style="min-height:89px">
                <h1 class="no-margins">'.$count[0]->viewed.'</h1>
                <!-- <div class="stat-percent font-bold">0%
                <i class="fa fa-level-up"></i>
                </div> -->
                <small>New visits</small>
              </div>';            
        }
        else{
           echo 
                '<div class="ibox-content" style="min-height:89px">
                    <h1 class="no-margins">No Views This Month</h1>
                    <div class="stat-percent font-bold">
                    <!-- <i class="fa fa-level-up"></i> -->
                    </div>
                    <small>&nbsp;</small>
                </div>';
        }
    }
    
    function view_year()
    {
        $start_date = date('Y-m-d H:i:s', strtotime('-365 days'));

        $end_date = date('Y-m-d H:i:s');

        $count = $this->viewed_model->_custom_query_count("SELECT COUNT(*) AS viewed FROM viewed WHERE viewed_id = '".$this->session->userdata('members_id')."' AND record_date BETWEEN '".$start_date."' AND '".$end_date."'");
        
        if($count[0]->viewed > 0){
            
            //$data['views_count'] = $count[0]->viewed;
            //$data['views'] = '
            echo  '      
              <div class="ibox-content" style="min-height:89px">
                <h1 class="no-margins">'.$count[0]->viewed.'</h1>
                <!-- <div class="stat-percent font-bold">0%
                <i class="fa fa-level-up"></i>
                </div> -->
                <small>New visits</small>
              </div>';            
        }
        else{
           echo 
                '<div class="ibox-content" style="min-height:89px">
                    <h1 class="no-margins">No Views This Year</h1>
                    <div class="stat-percent font-bold">
                    <!-- <i class="fa fa-level-up"></i> -->
                    </div>
                    <small>&nbsp;</small>
                </div>';
        }
    }
}