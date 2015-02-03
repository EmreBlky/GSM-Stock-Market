<?php

//    echo '<pre>';
//    print_r($logged);
//    exit;
?>			

    <div class="footer">
            <div class="pull-right">
               <strong>Last login:</strong> <?php echo $logged->date;?> at <?php echo $logged->time;?> from the IP <?php echo $logged->ip_address;?>
            </div>
            <div>
                <strong>Copyright</strong> GSM Stock Market Limited &copy; <?php echo date("Y"); ?>
            </div>
                               
        </div>
        </div>
    </div>