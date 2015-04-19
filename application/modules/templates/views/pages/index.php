<?php

if($main == 'login' || $main == 'register' || $page == 'invoice-print'){
    
    $this->load->module('header');
    $this->header->login_pre_header();
    $this->header->login_main_header();
    
}else{

    $this->load->module('header');
    $this->header->pre_header();
    $this->header->main_header();
}
?>

<?php

    $this->load->module($main);
    $this->{$main}->view($page);

?>

<?php

if($main == 'login' || $main == 'register' || $page == 'invoice-print'){
    
    $this->load->module('footer');
    $this->footer->login_main_footer();
    $this->footer->login_post_footer();
    
}else{

    $this->load->module('footer');
    $this->footer->main_footer();
    $this->footer->post_footer();

    
}
?>