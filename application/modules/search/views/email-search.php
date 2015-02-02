 <?php 
        $attributes = array('class' => 'pull-right mail-search');
        echo form_open('search/emailSearch/'.$category.'', $attributes); 
    ?>
    <div class="input-group">
        <input type="text" class="form-control input-sm" name="search" placeholder="Search email">
        <div class="input-group-btn">
            <button type="submit" class="btn btn-sm btn-primary">
                Searching
            </button>
        </div>
    </div>
 <?php echo form_close()?>
