<?php



if($page == 'login'){
    
    $this->load->module('header');
    $this->header->login_pre_header();
    $this->header->login_main_header();
    
}
else{

    $this->load->module('header');
    $this->header->admin_pre_header();
    $this->header->admin_main_header();

}
?>

<?php

    $this->load->module($main);
    $this->{$main}->view($page);

?>

<?php

if($page == 'login'){
    
    $this->load->module('footer');
    $this->footer->login_main_footer();
    $this->footer->login_post_footer();
    
}
else{

    $this->load->module('footer');
    $this->footer->admin_main_footer();
    $this->footer->admin_post_footer();

}

?>