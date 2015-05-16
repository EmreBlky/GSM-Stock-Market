<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imei extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('imei/imei_model', 'imei');
        $this->load->model('mobicode/mobicode_model', 'MobiCode');

        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        
        if ($this->session->userdata('terms') == 'no')
        { 
            redirect('legal/terms_conditions');
        }

        $has_imei_account = $this->imei->has_imei_account();

        $current_uri = uri_string();

        if (!$has_imei_account && $current_uri !== 'imei')
        {
            redirect('imei');
        }
        
        $this->load->model('activity/activity_model', 'activity_model');
        $this->load->model('imei/imei_model', 'imei_model');
        
    }

    function index()
    {
        $this->load->model('activity/activity_model', 'activity_model');
        $data_activity = array(
                                'activity' => 'IMEI: Index',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'imei';
		$data['title'] = 'IMEI Services';
        $data['page'] = 'index';
		
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function imei_lookup()
    {
        $lookup = false; 

        if (isset($_POST['lookup-service']))
        {
            if ($_POST['lookup-service'] !== 0)
            {
                # lookup switch
                switch ($_POST['lookup-service'])
                {
                    case '1-62':
                        $lookup = $this->imei_model->lookup_imei($_POST['imei']);
                        break;
                    case '1-129':
                        $lookup = $this->imei_model->lookup_bulk_imei($_POST['imei_bulk']);
                        break;
                }
            }
        }
        
        $data_activity = array(
                                'activity' => 'IMEI: TAC Code Lookup',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'imei';        
        $data['title'] = 'IMEI TAC Code Lookup';        
        $data['page'] = 'imei-lookup';
        $data['lookup_results'] = $lookup;
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function unlocking()
    {
        $data_activity = array(
                                'activity' => 'IMEI: Unlocking',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'imei';        
        $data['title'] = 'IMEI Unlocking';        
        $data['page'] = 'unlocking';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function archive()
    {
        $data_activity = array(
                                'activity' => 'IMEI: Archive',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));

        $hpi_checks = $this->imei_model->get_hpi_checks();
        $this->imei_model->fetch_api_orders();
        
        $data['main'] = 'imei';        
        $data['title'] = 'IMEI Archive';        
        $data['page'] = 'archive';
        $data['hpi_checks'] = $hpi_checks;
        $data['bulk_orders'] = $this->imei_model->get_bulk_orders();
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function top_up()
    {
        $encrypted = false;
        if (isset($_POST['top-up-account']))
        {
            $encrypted = $this->imei_model->top_up_account();
        }

        $data_activity = array(
            'activity' => 'IMEI: Top Up',
            'time' => date('H:i:s'),
            'date' => date('d-m-Y')
        );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'imei';        
        $data['title'] = 'IMEI Top up';        
        $data['page'] = 'top-up';
        $data['encrypted'] = $encrypted;
        
        $this->load->module('templates');
        $this->templates->page($data);
    }

    function report($order_id)
    {
        $this->load->model('activity/activity_model', 'activity_model');
        $data_activity = array(
                                'activity' => 'IMEI: Archive View',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));

        $this->imei_model->fetch_api_orders();
        
        $data['main'] = 'imei';
		$data['title'] = 'Report';
        $data['page'] = 'report';
        $data['order_info'] = $this->imei_model->get_order_info($order_id);
        $data['order_id'] = $order_id;
		
        $this->load->module('templates');
        $this->templates->page($data);
    } 
	
}