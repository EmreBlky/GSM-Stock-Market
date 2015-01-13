<?php

    $this->load->module('header');
    $this->header->login_pre_header();
    $this->header->login_main_header();

?>

<?php 

    $this->load->module('login');
    $this->login->view($page);
    
?>

<?php

    $this->load->module('footer');
    $this->footer->login_main_footer();
    $this->footer->login_post_footer();

?>