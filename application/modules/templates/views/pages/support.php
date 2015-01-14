<?php

$this->load->module('header');
$this->header->pre_header();
$this->header->main_header();
?>

<?php 

    $this->load->module('support');
    $this->support->view($page);
        
?>

<?php

$this->load->module('footer');
$this->footer->main_footer();
$this->footer->post_footer();

?>