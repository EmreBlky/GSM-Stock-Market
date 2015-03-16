<?php 
        $attributes = array('class' => '');
        echo form_open('search/addressbookSearch/', $attributes); 
    ?>
    <div class="input-group">
        <input type="text" class="form-control"id="search_addressbook" name="search" placeholder="Enter your search terms">
        <span class="input-group-btn" >
            <button type="submit" class="btn btn-primary">Search</button> 
        </span>
    </div>
 <?php echo form_close()?>