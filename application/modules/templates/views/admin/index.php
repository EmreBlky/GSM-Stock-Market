<?php

if($main == 'admin_login'){
    
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

if($main == 'admin_login'){
    
}
else{

    $this->load->module('footer');
    $this->footer->admin_main_footer();
    $this->footer->admin_post_footer();

}

?>