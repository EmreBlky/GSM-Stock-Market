<?php

$this->load->module('header');
$this->header->pre_header();
$this->header->main_header();
?>


<?php $this->load->helper(array('form', 'search')); ?>

<div id="content">
    
    <div class="content">

   <?php if ( ! is_null($results)): ?>
	<?php if (count($results)): ?>
		
		<p>Showing search results for '<?php echo $search_terms; ?>' (<?php echo $first_result; ?>&ndash;<?php echo $last_result; ?> of <?php echo $total_results; ?>):</p>
		
		<ul>
		<?php foreach ($results as $result): ?>
                    <li><a class="no_style" href="<?php echo $result->url; ?>"><font style="font-size: 24px;"><?php echo search_highlight($result->name, $search_terms); ?></font></a><?php echo search_highlight($result->main_content, $search_terms); ?></li>
		<?php endforeach ?>
		</ul>
		
		<?php echo $this->pagination->create_links(); ?>
		
	<?php else: ?>
                <?php 
                    $this->load->module('search');
                    $this->search->insert_query($search_query);
                ?>
		<p><em>There are no results for your query.</em></p>
	<?php endif ?>
<?php endif ?>
                
    </div>
    
</div>	



<?php

$this->load->module('footer');
$this->footer->main_footer();
$this->footer->post_footer();

?>