<?php

$this->load->module('header');
$this->header->admin_pre_header();
$this->header->admin_main_header();
?>

<?php 

    if($page == 'dashboard'){
        
        $this->load->module('admin');
        $this->admin->view_dashboard();
        
    }
    elseif($page == 'add-company'){
        
        $this->load->module('admin');
        $this->admin->view_add_company();
        
    }
    elseif($page == 'bulk-import'){
        
        $this->load->module('admin');
        $this->admin->view_bulk_import();
        
    }
    else{
        
        $this->load->module('admin');
        $this->admin->view_export();
    }; 
    
?>

<?php

$this->load->module('footer');
$this->footer->admin_main_footer();
$this->footer->admin_post_footer();

?>