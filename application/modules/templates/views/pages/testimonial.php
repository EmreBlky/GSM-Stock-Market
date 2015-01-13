<?php

$this->load->module('header');
$this->header->pre_header();
$this->header->main_header();

?>

<div id="content">

	<div class="content">
    
    	<h1><?php echo $query->name; ?></h1>
    
    	<?php echo $query->main_content; ?>
    
    </div>
    
    <div class="content">
    
    	<!--<h3 style="margin-top:0;">Customer Testimonials:</h3>-->
       
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script type="text/javascript">
        
			$(document).ready(function(){
	
			$('ul.tabs li').click(function(){
			var tab_id = $(this).attr('data-tab');
			
			$('ul.tabs li').removeClass('current');
			$('.tab-content').removeClass('current');
			
			$(this).addClass('current');
			$("#"+tab_id).addClass('current');
			})
			
			})
        
        </script>
        <?php echo $this->session->flashdata('success');?>
        <div class="container">
			
            <ul class="tabs">
                <li class="tab-link current" data-tab="tab-1">Customer Testimonials</li>
                <li class="tab-link" data-tab="tab-2">Feedback</li>        
            </ul>
            
            <div id="tab-1" class="tab-content current">
            <?php 
			
				$this->load->module('testimonial');
				$this->testimonial->index();
			?>            
            </div>
            
            <div id="tab-2" class="tab-content">
                 Please use the form below to leave your feedback/ Testimonial.
                 <div id="contact-area">
                 <form method="post" style="float:left;" action="testimonial/validate_form">
                    <input type="hidden" name="title" value="" />
                    <div style="width:850px; clear:left; float:left">
                    <label for="Name">&nbsp;Name:</label>
                    <input type="text" name="name" id="name" value="<?php echo $this->input->post('name');?>" />
                    </div>
                    <div style="width:850px; clear:left; float:left">
                    <label>Rate:</label>
                    <input type="radio" name="rate" value="1" style="width:15px;"/>&nbsp;&nbsp;1 Star&nbsp;&nbsp;
                    <input type="radio" name="rate" value="2" style="width:15px;"/>&nbsp;&nbsp;2 Stars&nbsp;&nbsp;
                    <input type="radio" name="rate" value="3" style="width:15px;"/>&nbsp;&nbsp;3 Stars&nbsp;&nbsp;
                    <input type="radio" name="rate" value="4" style="width:15px;"/>&nbsp;&nbsp;4 Stars&nbsp;&nbsp;	
                    <input type="radio" name="rate" value="5" style="width:15px;"/>&nbsp;&nbsp;5 Stars&nbsp;&nbsp;
                    </div>
                    <div style="width:850px; clear:left; float:left">
                    <label for="Message" style="margin-top:10px;">&nbsp;Message:</label><br />
                    <textarea name="message" rows="20" cols="60" id="message"><?php echo $this->input->post('message');?></textarea>
                    </div>
                    <input type="hidden" name="spam_bots" value="" />
                    <div style="width:600px;float:left">
                    <input type="submit" name="submit" value="Submit" class="submit-button" />
                    </div>
                </form>
                </div>
            </div>
        
        </div><!-- container -->
        
    </div>
    
</div>

<?php

$this->load->module('footer');
$this->footer->main_footer();
$this->footer->post_footer();

?>
