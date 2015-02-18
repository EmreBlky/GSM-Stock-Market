<?php

//echo '<pre>';
//print_r($membership);
//exit;

$this->load->model('member/member_model', 'member_model');
$this->load->model('company/company_model', 'company_model');
?>
<script type="text/javascript">

    function updateYes(mid, variable, value)
    {
       
        var member      = "'"+ mid +"'";
        var memb_var    = "'"+ variable +"'";
        var memb_value  = "'no'";;
        
//        alert(member);
//        alert(memb_var);
//        alert(memb_value);
        
            $.ajax({
                    type: "POST",
                    url: "admin/updateUserLevel/"+ mid +"/"+ variable +"/"+ value +"",
                    dataType: "html",
                    success:function(data){
                      $('#'+variable+'_yes_'+mid+'').replaceWith('<button type="submit" class="btn btn-white btn-sm" id="'+variable+'_no_'+mid+'" onclick="updateNo('+ member +', '+ memb_var + ', '+ memb_value +');"><i class="fa fa-check text-navy"></i></button>');  
                      toastr.success('You have updated that membership.', 'Membership Updated');
                    },
            });
        }
        
        function updateNo(mid, variable, value)
        {
            //alert(mid);
            //alert(variable);
            //alert(value);

            var member      = "'"+ mid +"'";
            var memb_var    = "'"+ variable +"'";
            var memb_value  = "'yes'";
//            
//            alert(member);
//            alert(memb_var);
//            alert(memb_value);

                $.ajax({
                        type: "POST",
                        url: "admin/updateUserLevel/"+ mid +"/"+ variable +"/"+ value +"",
                        dataType: "html",
                        success:function(data){
                          $('#'+variable+'_no_'+mid+'').replaceWith('<button type="submit"  class="btn btn-white btn-sm"  id="'+variable+'_yes_'+mid+'"  onclick="updateYes('+ member +', '+ memb_var + ', '+ memb_value +');"><i class="fa fa-times text-warning"></i></button>');  
                          toastr.success('You have updated that membership.', 'Membership Updated');
                        },
                });
            }
   

</script>
<div class="clear" style="margin-bottom: 10px;"></div>
    <div class="row">

 
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>User Level Management</h5>
                
            </div>
            <div class="ibox-content">
               
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th>Sales</th>
                            <th>Purchase</th>
                            <th>Visits</th>
                            <th>Rate Member</th>
                            <th>Orders</th>
                            <th>Buying</th>
                            <th>Messenger</th>
                            <th>Addressbook</th>
                            <th>Online Auction (Bid)</th>
                            <th>Online Auction (Sell)</th>
                            <th>Search</th>
                            <th>My Wallet</th>
                            <th>IMEI</th>
                            <th>Support</th>
                            <th>Preferences</th>
                            <th>Dedicated Manager</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($membership as $memb) {?>    
                        <tr>
                            <td><?php echo $memb->membership; ?></td>
                            <?php if($memb->sales == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','sales', 'no');" type="submit" class="btn btn-white btn-sm" id="sales_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'sales', 'yes');" type="submit" class="btn btn-white btn-sm" id="sales_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>
                            <?php if($memb->purchase == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','purchase', 'no');" type="submit" class="btn btn-white btn-sm" id="purchase_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'purchase', 'yes');" type="submit" class="btn btn-white btn-sm" id="purchase_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>
                            <?php if($memb->visits == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','visits', 'no');" type="submit" class="btn btn-white btn-sm" id="visits_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'visits', 'yes');" type="submit" class="btn btn-white btn-sm" id="visits_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>
                            <?php if($memb->rate == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','rate', 'no');" type="submit" class="btn btn-white btn-sm" id="rate_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'rate', 'yes');" type="submit" class="btn btn-white btn-sm" id="rate_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>
                            <?php if($memb->orders == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','orders', 'no');" type="submit" class="btn btn-white btn-sm" id="orders_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'orders', 'yes');" type="submit" class="btn btn-white btn-sm" id="orders_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>
                            <?php if($memb->buying == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','buying', 'no');" type="submit" class="btn btn-white btn-sm" id="buying_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'buying', 'yes');" type="submit" class="btn btn-white btn-sm" id="buying_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>
                            <?php if($memb->messenger == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','messenger', 'no');" type="submit" class="btn btn-white btn-sm" id="messenger_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'messenger', 'yes');" type="submit" class="btn btn-white btn-sm" id="messenger_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>
                            <?php if($memb->addressbook == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','addressbook', 'no');" type="submit" class="btn btn-white btn-sm" id="addressbook_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'addressbook', 'yes');" type="submit" class="btn btn-white btn-sm" id="addressbook_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>  
                            <?php if($memb->online_auction_bid == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','online_auction_bid', 'no');" type="submit" class="btn btn-white btn-sm" id="online_auction_bid_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'online_auction_bid', 'yes');" type="submit" class="btn btn-white btn-sm" id="online_auction_bid_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>
                            <?php if($memb->online_auction_sell == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','online_auction_sell', 'no');" type="submit" class="btn btn-white btn-sm" id="online_auction_sell_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'online_auction_sell', 'yes');" type="submit" class="btn btn-white btn-sm" id="online_auction_sell_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>  
                            <?php if($memb->search == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','search', 'no');" type="submit" class="btn btn-white btn-sm" id="search_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'search', 'yes');" type="submit" class="btn btn-white btn-sm" id="search_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>
                            <?php if($memb->my_wallet == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','my_wallet', 'no');" type="submit" class="btn btn-white btn-sm" id="my_wallet_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'my_wallet', 'yes');" type="submit" class="btn btn-white btn-sm" id="my_wallet_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>
                            <?php if($memb->imei == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','imei', 'no');" type="submit" class="btn btn-white btn-sm" id="imei_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'imei', 'yes');" type="submit" class="btn btn-white btn-sm" id="imei_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>
                            <?php if($memb->support == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','support', 'no');" type="submit" class="btn btn-white btn-sm" id="support_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'support', 'yes');" type="submit" class="btn btn-white btn-sm" id="support_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>  
                            <?php if($memb->preferences == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','preferences', 'no');" type="submit" class="btn btn-white btn-sm" id="preferences_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'preferences', 'yes');" type="submit" class="btn btn-white btn-sm" id="preferences_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?> 
                            <?php if($memb->dedicated_manager == 'yes'){?>
                                <td>
                                    <button onclick="updateNo('<?php echo $memb->id; ?>','dedicated_manager', 'no');" type="submit" class="btn btn-white btn-sm" id="dedicated_manager_no_<?php echo $memb->id?>"><i class="fa fa-check text-navy"></i></button>
                                </td>
                            <?php }else {?>
                                <td>
                                    <button onclick="updateYes('<?php echo $memb->id; ?>', 'dedicated_manager', 'yes');" type="submit" class="btn btn-white btn-sm" id="dedicated_manager_yes_<?php echo $memb->id?>"><i class="fa fa-times text-warning"></i></button>
                                </td>
                            <?php }?>    
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        
    </div>

</div>
<script src="public/main/template/core/js/plugins/jsKnob/jquery.knob.js"></script>
        
    <!-- Toastr script -->
    <script src="public/main/template/core/js/plugins/toastr/toastr.min.js"></script><!-- ALERTS -->
    
    <script type="text/javascript">
        $(function () {
                toastr.options = {
                    closeButton: false,
                    debug:false,
                    progressBar: false,
                    positionClass: 'toast-bottom-right',
                    onclick: null,
					showDuration: 400,
					hideDuration: 1000,
					timeOut: 7000,
					extendedTimeOut: 1000,
					showEasing: 'swing',
					hideEasing: 'linear',
					showMethod: 'fadeIn',
					hideMethod: 'fadeOut',
				};
                                
            $(".dial").knob();                    
        });
    </script>

