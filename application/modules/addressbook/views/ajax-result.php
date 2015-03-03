<div class="row original">
        <?php 
        
            if($addressbook_count > 0){
                echo '<pre>';
                print_r($address_book);
            }
            else{
                echo 'NO RESULTS FOUND';
            }
        
        ?>
</div><!-- Row End -->