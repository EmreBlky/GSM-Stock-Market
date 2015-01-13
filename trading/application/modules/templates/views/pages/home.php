<?php

$this->load->module('header');
$this->header->pre_header();
$this->header->main_header();
?>

<?php 

    if($page == 'index'){
        
        $this->load->module('home');
        $this->home->view($page);
        
    }
    else{
        
        $this->load->module('home');
        $this->home->view($page);
    }; 
    
?>

<?php

$this->load->module('footer');
$this->footer->main_footer();
$this->footer->post_footer();

?>
