<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketplace extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
    }

    function index()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function buy()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Purchase';        
        $data['page'] = 'buy';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function sell()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Sell';        
        $data['page'] = 'sell';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function watching()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Watching';        
        $data['page'] = 'watching';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function all()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: All';        
        $data['page'] = 'all';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function invoice()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Invoice';        
        $data['page'] = 'invoice';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function create_listing()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Create Listing';        
        $data['page'] = 'create-listing';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function open_orders()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Open Orders';        
        $data['page'] = 'open-orders';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function listing()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Listing';        
        $data['page'] = 'my-listings';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function sell_listing()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Sell Listing';        
        $data['page'] = 'sell-listing';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function saved_listing()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Saved Listing';        
        $data['page'] = 'saved-listing';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function buy_listing()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Buy Listing';        
        $data['page'] = 'buy-listing';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function history()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: History';        
        $data['page'] = 'order-history';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function invoice_print()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Invoice Print';        
        $data['page'] = 'invoice-print';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
	
}