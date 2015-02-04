<?php

//echo '<pre>';
//print_r($list_company);
//echo '</pre>';
function flags($country)
{
    $country = ucfirst($country);
    $country = str_replace(" ", "_", $country);
    
    return $country;
}

?>

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Individuals</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home">Home</a>
                        </li>                        
                        <li class="active">
                            <strong>Individuals</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            
           <?php foreach ($list_company as $company){?> 
            <div class="col-lg-4">
                <div class="contact-box">
                    <a href="company/profile/<?php echo $company->id; ?>">
                    <div class="col-sm-4">
                        <div class="text-center">                            
                            <?php if(file_exists("public/main/images/company/".$company->id.".jpg")){?>
                                <img alt="image" class="img-circle m-t-xs img-responsive" src="public/main/images/company/<?php echo $company->id; ?>.jpg" height="128" width="128"/>
                            <?php } else {?>
                                <img src="public/main/images/company/no_company.jpg" height="128" width="128"/>
                            <?php }?>
                        </div>
                        <div class="text-center" style="margin-top:10px">
                            <span class="label label-danger">Offline</span><br /><br />
                            
                        </div>
                    </div>
                    </a>
                    <div class="col-sm-8">
                    	<div class="col-sm-12" style="padding:0">
                    	<div class="col-sm-8" style="padding:0">
                        <h3 style="margin-bottom:0"><strong><?php echo $company->company_name;?></strong></h3>
                        </div>
                        <div class="col-sm-4" style="padding:5px 0">
                            <img alt="image" style="float:right" src="public/main/images/flags/<?php echo flags($company->country); ?>.png" title="<?php echo $company->country; ?>">
                        </div>
                        </div>
<!--                        <div><?php echo $member->role;?></div>
                        <h4 style="margin-bottom:0">
                            <strong>GSMStockMarket.com Limited</strong>
                        </h4>-->
                            <p>
                               - <?php echo $company->business_sector_1;?><br />
                               - <?php echo $company->business_sector_2;?><br />
                               - <?php echo $company->business_sector_3;?>
                            </p>
                        
                    </div>
                    <div class="col-sm-12">
                            <button class="btn btn-primary" type="button" style="font-size:10px;float:right;margin-right:0" data-toggle="modal" data-target="#profile_message"><i class="fa fa-envelope"></i>&nbsp;Message</button>
                            <a href="company/profile/<?php echo $company->id; ?>" class="btn btn-success" type="button" style="font-size:10px;float:right;margin-right:10px;"><i class="fa fa-user"></i>&nbsp;View Profile</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
           <?php } ?>
            
        </div>
        </div>