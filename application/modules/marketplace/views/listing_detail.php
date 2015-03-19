<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
        <li>
            <a href="/">Home</a>
        </li>
        <li class="active">
            <strong>Listing Details</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
</div>

<div class="wrapper wrapper-content">
<form method="post" action="<?php echo current_url()?>"  class="validation form-horizontal"  enctype="multipart/form-data"/>  
<div class="row">
<div class="col-lg-12">
<?php msg_alert(); ?>
    <div class="ibox float-e-margins">
<div class="ibox-title">
<h5>Listing Details
<?php if (!empty($member_id) && $member_id==$listing_detail->member_id): ?>
    <span class="label label-danger pull-right">this is your listing</span>
<?php endif ?></h5>

</div>
<div class="ibox-content">
<div class="wrapper wrapp er-content">
     <div class="row">
                <div class="col-lg-6">               
                    <dl class="dl-horizontal">
                        <h4>Product Details</h4>
                        <dt>Make:</dt> <dd>  <?php if(!empty($listing_detail->product_make)) { echo $listing_detail->product_make; } ?></dd>
                        <dt>Model:</dt> <dd>  <?php if(!empty($listing_detail->product_model)) { echo $listing_detail->product_model; } ?></dd>
                        <!-- <dt>Memory:</dt> <dd> <?php //if(!empty($listing_detail->product_make)) { echo $listing_detail->product_make; } ?></dd> -->
                        <dt>Colour:</dt> <dd>  <?php if(!empty($listing_detail->product_color)) { echo $listing_detail->product_color; } ?></dd>
                        <dt>Product Type:</dt> <dd>  <?php if(!empty($listing_detail->product_type)) { echo $listing_detail->product_type; } ?></dd>
                        <dt>Condition:</dt> <dd>  <?php if(!empty($listing_detail->condition)) { echo $listing_detail->condition; } ?></dd> 
                        <dt>Spec</dt> <dd>  <?php if(!empty($listing_detail->spec)) { echo $listing_detail->spec; } ?></dd>
                        <dt>MPN</dt> <dd>  <?php if(!empty($listing_detail->product_mpn)) { echo $listing_detail->product_mpn; } ?></dd>
                        <dt>ISBN</dt> <dd>  <?php if(!empty($listing_detail->product_isbn)) { echo $listing_detail->product_isbn; } ?></dd>
                       <!--  <dt>Network</dt> <dd>  <?php //if(!empty($listing_detail->product_make)) { echo $listing_detail->product_make; } ?></dd> -->
                        <dt>Quantity</dt> <dd> <?php if(!empty($listing_detail->qty_available)) { echo $listing_detail->qty_available; } ?></dd>
                    </dl>
                      <div class="hr-line-dashed"></div>
                    <dl class="dl-horizontal">
                        <h4>Price</h4>
                        <dt>Sale Currency:</dt> <dd> <?php if(!empty($listing_detail->currency)) { echo currency_class($listing_detail->currency); } ?></dd>
                        <dt>GBP Price:</dt> <dd><strong>  &pound; <?php echo get_currency(currency_class($listing_detail->currency), 'GBP', $listing_detail->unit_price); ?></strong></dd>
                        <dt>EUR Price:</dt> <dd>  &euro; <?php echo get_currency(currency_class($listing_detail->currency), 'EUR', $listing_detail->unit_price); ?></dd>
                        <dt>USD Price:</dt> <dd>  $ <?php echo get_currency(currency_class($listing_detail->currency), 'USD', $listing_detail->unit_price); ?></dd>
                    </dl>
                     <div class="hr-line-dashed"></div> 
                    <dl class="dl-horizontal">
                        <h4>Shipping</h4>
                        <dt>Courier</dt> <dd> <?php if(!empty($listing_detail->courier)) { echo $listing_detail->courier; } ?></dd>
                        <dt>Terms:</dt> <dd> <?php if(!empty($listing_detail->shipping_term)) { echo $listing_detail->shipping_term; } ?></dd>
                    </dl>
                  <div class="hr-line-dashed"></div>
                </div>
                <div class="col-lg-6">
                    <p style="text-align:center">
                       <?php if(!empty($listing_detail->image1)) { ?>
                        <img style="height: 300px;" src="<?php echo base_url().$listing_detail->image1; ?>" /><br/><br/>
                        <?php } ?>
                         <?php if(!empty($listing_detail->image1)) { ?>
                        <a class="fancybox" rel="gallery1" href="<?php echo base_url().$listing_detail->image1; ?>" title="<?php echo base_url().$listing_detail->image1; ?>">
                            <img src="<?php echo base_url().$listing_detail->image1; ?>" alt="" />
                        </a>
                        <?php } ?>
                         <?php if(!empty($listing_detail->image2)) { ?>
                        <a class="fancybox" rel="gallery1" href="<?php echo base_url().$listing_detail->image2; ?>" title="<?php echo base_url().$listing_detail->image2; ?>">
                            <img src="<?php echo base_url().$listing_detail->image2; ?>" alt="" />
                        </a>
                        <?php } ?>
                         <?php if(!empty($listing_detail->image3)) { ?>
                        <a class="fancybox" rel="gallery1" href="<?php echo base_url().$listing_detail->image3; ?>" title="<?php echo base_url().$listing_detail->image3; ?>">
                            <img src="<?php echo base_url().$listing_detail->image3; ?>" alt="" />
                        </a>
                        <?php } ?>
                         <?php if(!empty($listing_detail->image4)) { ?>
                        <a class="fancybox" rel="gallery1" href="<?php echo base_url().$listing_detail->image4; ?>" title="<?php echo base_url().$listing_detail->image4; ?>">
                            <img src="<?php echo base_url().$listing_detail->image4; ?>" alt="" />
                        </a>
                        <?php } ?>
                        <?php if(!empty($listing_detail->image5)) { ?>
                        <a class="fancybox" rel="gallery1" href="<?php echo base_url().$listing_detail->image5; ?>" title="<?php echo base_url().$listing_detail->image5; ?>">
                            <img src="<?php echo base_url().$listing_detail->image5; ?>" alt="" />
                        </a>
                        <?php } ?>

                    </p>
                    <div style="text-align:center">
                        <?php if(!empty($listing_detail->listing_end_datetime)) { ?> 
                        <span style="color:red">Listing Ends: <?php echo $listing_detail->listing_end_datetime; ?></span><br /><br />
                        <?php } ?>
                        <button type="button" class="btn btn-danger" style="font-size:10px">Pay asking price</button>
                    </div>

                         <?php if (!empty($member_id) && $member_id!=$listing_detail->member_id): ?>
                    <dl class="dl-horizontal" style="margin-top:20px" disabled>
                        <h4>or Make an Offer</h4>
                        <dt><div class="input-group m-b"><span class="input-group-addon">QTY</span>  
                            <input type="text" class="form-control" /><span class="input-group-addon">@</span></dt> 
                            <dd><div class="input-group m-b"><span class="input-group-addon"><?php if(!empty($listing_detail->currency)) { echo $listing_detail->currency; } ?></span>  
                        
                        <input type="text" class="form-control" /></dd>
                        <p style="text-align:center"><button type="button" class="btn btn-warning" style="font-size:10px">Send Offer</button></p>

                        <p class="small" style="text-align:center">Offers sent will expire after 24 hours</p>
                        </dd>
                         <?php endif; ?>

                </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <h4>Product Description</h4>
                    <p><?php if(!empty($listing_detail->product_desc)) { echo $listing_detail->product_desc; } ?></p>
                    </div>
              
              </div>


    </div>
  <div class="modal-footer">
        <?php if (!empty($member_id) && $member_id!=$listing_detail->member_id): ?>
            <a href="<?php echo base_url().'marketplace/listing_watch/'.$listing_detail->id ?>" class="btn btn-warning">Watch</a>
           <!--  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#price_graph">Product Price Data</button> -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profile_user">Seller Profile</button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#profile_message">Ask a question</button>
        <?php endif; ?>
            <a href="<?php echo base_url().'marketplace/sell' ?>" class="btn btn-white">Back</a>
        </div>
                

  </div>
 </div> 
</div>       
       
</div>
</form>
</div>


    <style>
.error{
  color:rgba(255, 0, 0, 0.7);
  padding-left: 5px;
}
.error:before{
    content: "*";
    padding: 3px;
}
</style>

   <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title"><strong>Selling Offer</strong> by GSMStockMarket.com Limited</h4>
                                            <small class="font-bold">Transaction ID: 0123456789-01</small>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <dl class="dl-horizontal">
                                                        <h4>Product Details</h4>
                                                        <dt>Make:</dt> <dd>  Apple</dd>
                                                        <dt>Model:</dt> <dd>  iPhone 4S</dd>
                                                        <dt>Memory:</dt> <dd>  16GB</dd>
                                                        <dt>Colour:</dt> <dd>  Black</dd>
                                                        <dt>Product Type:</dt> <dd>  Data Cable</dd>
                                                        <dt>Condition:</dt> <dd>  Refurbished</dd>
                                                        <dt>Spec</dt> <dd>  UK</dd>
                                                        <dt>MPN/ISBN</dt> <dd>  GH98-23907342</dd>
                                                        <dt>Network</dt> <dd>  Network Locked</dd>
                                                        <dt>Quantity</dt> <dd>  29</dd>
                                                    </dl>
                                                    <dl class="dl-horizontal">
                                                        <h4>Price</h4>
                                                        <dt>Sale Currency:</dt> <dd> GBP &pound;</dd>
                                                        <dt>GBP Price:</dt> <dd><strong>  &pound;96.00</strong></dd>
                                                        <dt>EUR Price:</dt> <dd>  &euro;130.55</dd>
                                                        <dt>USD Price:</dt> <dd>  $147.59</dd>
                                                    </dl>
                                                    <dl class="dl-horizontal">
                                                        <h4>Shipping</h4>
                                                        <dt>Courier</dt> <dd> DHL</dd>
                                                        <dt>Terms:</dt> <dd> CIF</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-6">
                                                    <p style="text-align:center">
                                                        <img style="text-align:center" src="public/main/template/gsm/images/marketplace/marketplace_photo.png" /><br /><br />
                                                        <span style="color:red">Listing Ends: 4d 23h 22m 13s</span><br /><br />
                                                        <button type="button" class="btn btn-danger" style="font-size:10px">Pay asking price</button>
                                                    </p>

                                                    <dl class="dl-horizontal" style="margin-top:20px">
                                                        <h4>or Make an Offer</h4>
                                                        <dt><div class="input-group m-b"><span class="input-group-addon">QTY</span>
                                                            <input type="text" class="form-control" /><span class="input-group-addon">@</span></dt>
                                                            <dd><div class="input-group m-b"><span class="input-group-addon">GBP <i class="fa fa-gbp"></i></span>
                                                            <input type="text" class="form-control" /></dd>
                                                        <p style="text-align:center"><button type="button" class="btn btn-warning" style="font-size:10px">Send Offer</button></p>
                                                        <p class="small" style="text-align:center">Offers sent will expire after 24 hours</p>

                                                </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                    <h4>Product Description</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent diam odio, ultrices vitae erat quis, tristique posuere leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tristique massa et justo laoreet, et finibus lacus scelerisque. Suspendisse id orci vel sapien mollis dictum. Aenean id nisl pulvinar, euismod risus id, pharetra velit. In finibus libero sed elit viverra, hendrerit tincidunt lectus maximus. Nulla facilisi. Nulla tellus justo, lacinia eget mauris nec, imperdiet tincidunt elit. Donec elementum enim id felis commodo, non porta tortor sagittis.</p>
                                                    </div>

                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning">Watch</button>
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#price_graph">Product Price Data</button>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profile_user">Seller Profile</button>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#profile_message">Ask a question</button>
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                            <div class="modal inmodal fade" id="profile_user" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title"View Profile</h4>
                                            <small class="font-bold"><?php if(!empty($company->company_name)) echo $company->company_name ?></small>
                                        </div>
                                        <div class="modal-body">
                                          <!--   <img src="public/main/template/gsm/images/marketplace/profile_summary.jpg" /> -->


<style>
table tr th{vertical-align: top;}
table tr td{
padding-left:20px;}
</style>
<div class="row" style="background:#FFF;">
    <div class="col-md-8 col-md-offset-1">
        <h1><?php if(!empty($company->company_name)) echo $company->company_name ?></h1>
    </div>
    <div class="col-md-6">

        <table width="100%" border="0" cellpadding="5" cellspacing="5">
            <tr>
                <th width="55%" class="text-right">Status : </th>
                <td class="pull-left">                 <?php //print_r($company) ?>
                <?php //if(!empty($company)) { ?>
                    <?php //if ($company->status==0): ?>
                    <!-- <span class="label label-danger pull-right">Pending</span> -->
                    <?php //endif ?>
                     <?php //if ($company->status==1): ?>
                    <!-- <span class="label label-primary pull-right">Active</span> -->
                    <?php //endif ?>
                     <?php //if ($company->status==2): ?>
                    <!-- <span class="label label-warning pull-right">Save For later</span> -->
                    <?php //endif ?>
                     <?php //if ($company->status==3): ?>
                    <!-- <span class="label label-danger pull-right">Inactive</span> -->
                    <?php //endif ?>
                <?php //} ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <th class="text-right">Subscription: </th>
                <td> <?php if(!empty($memberships->membership)) echo $memberships->membership." Member"; ?></td>
            </tr>
            <tr>
                <th class="text-right">Company Number:</th>
                <td> <?php if(!empty($company->company_number)) echo $company->company_number ?></td>
            </tr>
            <tr>
                <th class="text-right"> VAT/Tax Number:</th>
                <td> <?php if(!empty($company->vat_tax)) echo $company->vat_tax ?></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <th class="text-right">Address:</th>
                <td>
                <?php if(!empty($company->address_line_1)) echo $company->address_line_1 ?><br>
                <?php if(!empty($company->address_line_2)) echo $company->address_line_2 ?><br>
                <?php if(!empty($company->town_city)) echo $company->town_city ?><br>
                <?php if(!empty($company->county)) echo $company->county ?><br>
                <?php if(!empty($company->post_code)) echo $company->post_code ?><br>
                <?php if(!empty($company->country)) echo $company->country ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <th class="text-right">Primary Business:</th>
                <td> <?php if(!empty($company->business_sector_1)) echo $company->business_sector_1 ?></td>
            </tr>
            <tr>
                <th class="text-right">Secondary Business:</th>
                <td > <?php if(!empty($company->business_sector_2)) echo $company->business_sector_2 ?></td>
            </tr>
            <tr>
                <th class="text-right">Tertiary Business:</th>
                <td> <?php if(!empty($company->business_sector_3)) echo $company->business_sector_3 ?></td>
            </tr>
            <tr>
                <th class="text-right" valign="top">Other Activities :</th>
                <td> <?php if(!empty($company->other_business)) echo $company->other_business ?></td>
            </tr>
        </table>

    </div>
    <div class="col-md-6">

        <table  width="100%" border="0" cellpadding="5" cellspacing="5">
            <tr>
                <th class="text-right"></th>
                <th align="center0">
                      <img width="200" src="public/main/template/gsm/images/marketplace/profile_graph.png" />
                </th>
            </tr>
             <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <th width="35%" class="text-right">Title:</th>
                <td width="50%">  <?php if(!empty($member->firstname)) echo $member->firstname ?></td>
            </tr>
            <tr>
                <th class="text-right">Firstname: </th>
                <td> <?php if(!empty($member->firstname)) echo $member->firstname ?></td>
            </tr>
            <tr>
                <th class="text-right">Surname:  </th>
                <td> <?php if(!empty($member->lastname)) echo $member->lastname ?></td>
            </tr>
            <tr>
                <th class="text-right">Role: </th>
                <td> <?php if(!empty($member->role)) echo $member->role ?></td>
            </tr>
            <tr>
                <th class="text-right">Phone Number: </th>
                <td> <?php if(!empty($member->phone_number)) echo $member->phone_number ?></td>
            </tr>
            <tr>
                <th class="text-right">Mobile Number: </th>
                <td> <?php if(!empty($member->mobile_number)) echo $member->mobile_number ?></td>
            </tr>
            <tr>
                <th class="text-right">Facebook: </th>
                <td> <?php if(!empty($member->facebook)) echo $member->facebook ?></td>
            </tr>
            <tr>
                <th class="text-right">Twitter: </th>
                <td> <?php if(!empty($member->twitter)) echo $member->twitter ?></td>
            </tr>
            <tr>
                <th class="text-right">Google Plus: </th>
                <td> <?php if(!empty($member->gplus)) echo $member->gplus ?></td>
            </tr>
            <tr>
                <th class="text-right">LinkedIn: </th>
                <td> <?php if(!empty($member->linkedin)) echo $member->linkedin ?></td>
            </tr>
            <tr>
                <th class="text-right">Skype: </th>
                <td> <?php if(!empty($member->skype)) echo $member->skype ?></td>
            </tr>
        </table>

    </div>
</div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal inmodal fade" id="price_graph" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">iPhone 4S Buy &amp; Sell Data</h4>
                                            <span>Buying Price</span> / <span style="color:#8fd9ca">Selling Price</span>
                                        </div>
                                        <div class="modal-body">
                                            <img src="public/main/template/gsm/images/marketplace/product_data.jpg" />
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal inmodal fade" id="profile_message" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Ask Question</h4>
                                            <small class="font-bold">Welcome to GSMStockMarket.com. Ask your question.</small>
                                        </div>

                                        <form id="question_form">
                                            <div class="modal-body">
                                            <div id="msg"></div>
                                                <input type="hidden" name="listing_id" class="listing" value="<?php if(!empty($listing_detail->id)) echo $listing_detail->id; ?>"/>
                                                <input type="hidden" name="seller_id" value="<?php if(!empty($listing_detail->member_id)) echo $listing_detail->member_id; ?>"/>
                                                <textarea rows="10" cols="10" class="form-control" name="ask_question" placeholder="Enter your question." required></textarea>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="send_msg">Send Message</button>
                                            </div>
                                        </form>
                                        <div class="question_list"></div>
                                    </div>
                                </div>
                            </div>
<script>
    $(document).ready(function(){
        $('#send_msg').on('click', function(){
          var question_form =  $('#question_form').serialize();
          $.post('<?php echo base_url() ?>marketplace/listing_question', question_form,function(data){
            $('#msg').html(data);
           });
        });
       

        $.get('<?php echo base_url()."marketplace/get_listing_question/".$listing_detail->id; ?>', function(data){
            $('.question_list').html(data);
           })

        $(".fancybox").fancybox({
        openEffect  : 'none',
        closeEffect : 'none'
        });
    });

// function delete_data(row_id) {
//     if(confirm('Are you sure want to delete')){
//         $.post('<?php echo base_url()."marketplace/delete_listing_question/"; ?>',{row_id:row_id},function(data){
//             $('#del_msg').html(data);
//            });
//         $.get('<?php echo base_url() ?>marketplace/get_listing_question', function(data){
//             $('.question_list').html(data);
//            })
//      }else{
//         return false;
//      }
// }
</script>
<style>
    .question_list{
        padding: 0 3%;
    }
</style>

