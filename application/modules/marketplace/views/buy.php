<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2>Selling Offers</h2>
    <ol class="breadcrumb">
        <li>
            <a href="/">Home</a>
        </li>
        <li>
            Marketplace
        </li>
        <li class="active">
            <strong>Buy</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
</div>

<?php if(!empty($member) && $member->membership > 1 ) {?> 

<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Search</h5>
    </div>

<?php
$dataasa=array();
if(!empty($advance_search)):
foreach ($advance_search as $row) {
$dataasa['product_mpn'][]        = $row->product_mpn_isbn;
//$dataasa['product_isbn'][]       = $row->product_isbn;
$dataasa['product_make'][]       = $row->product_make ;
$dataasa['product_model'][]      = $row->product_model ;
$dataasa['product_type'][]       = $row->product_type;
$dataasa['product_countrys'][]   = array('country_id'=>$row->country_id,'product_country'=>$row->product_country);
}
endif;
?>

    <div class="ibox-content">
     <form action="<?php echo base_url('marketplace/buy'); ?>/<?php echo $offset ?>/" method="get" accept-charset="utf-8">
           <div class="row">
            <div class="col-lg-3" style="padding-right:0">
            	<select name="lc" class="form-control" tabindex="1">
                	<option value="" selected="">All Categories</option>
                    <?php if (!empty($listing_categories)): ?>
                    <?php foreach ($listing_categories as $row): ?>
                       <option value="<?php echo $row->category_name ?>" <?php if(!empty($_GET['lc']) && $row->category_name==$_GET['lc']){ echo'selected';}?> ><?php echo $row->category_name ?></option>
                        <?php if (!empty($row->childs)): ?>
                            <?php foreach ($row->childs as $child): ?>
                                <option value="<?php echo $child->category_name ?>" <?php if(!empty($_GET['lc']) && $child->category_name==$_GET['lc']){ echo'selected';}?> >- <?php echo $child->category_name ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
        	<div class="col-lg-7" style="padding-right:0">
                <select name="query" data-placeholder="All Makes & Models" id="models" class="chosen-select form-control" tabindex="1">
                 <option value="">Search here </option>
                  <?php if(!empty($dataasa['product_make'])){
                  foreach (array_unique ($dataasa['product_make']) as $row) { ?>
                  <option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                  <?php }} ?>
                  <?php if(!empty($dataasa['product_model'])){
                  foreach (array_unique ($dataasa['product_model']) as $row) { ?>
                  <option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                  <?php }} ?>

                </select>
            </div>
        	<div class="col-lg-2">
            	<input type="submit" class="btn btn-primary" style="width:100%" value="Search"/>
            </div>
           
        </div>
        </form>
        <div class="row">

            <div class="col-lg-12">

                <div class="text-right">
                    <button class="btn btn-primary0" type="button" data-toggle="collapse" data-target="#AdvanceSearch" aria-expanded="true" aria-controls="collapseExample">Advance Search</button>
                </div>

                <div id="AdvanceSearch"   <?php if(isset($_GET['search'])) echo 'class="collapse in" aria-expanded="true"'; else echo 'class="collapse"'; ?> style=" border: 1px solid #f0f0f0; padding: 10px;">
                <div class="well0 row">
                 <form action="<?php echo base_url('marketplace/buy'); ?>/<?php echo $offset ?>/" method="get" accept-charset="utf-8">

                    <div class="col-lg-4">
                        <div class="form-group">
                         <label for="">Search by Date</label>
                            <input type="text" class="form-control" id="date" name="date" placeholder="format (yyyy-mm-dd)" value="<?php if(!empty($_GET['date'])) echo $_GET['date'] ?>">
                        </div>
                         <div class="form-group">
                          <label for="">Search by MPN/ISBN</label>
                            <input type="type" class="form-control" id="mpn" list="mpns" name="mpn" placeholder="MPN/ISBN" value="<?php if(!empty($_GET['mpn'])) echo $_GET['mpn'] ?>">
                             <datalist id="mpns">
                            <?php if(!empty($dataasa['product_mpn'])){
                                 foreach (array_unique ($dataasa['product_mpn']) as $row) { ?>
                               <option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                                 <?php }} ?>
                            </datalist>
                        </div>
                         <div class="form-group">
                            <label for="">Search By Model</label>
                            <input type="type" class="form-control" list="modelss" id="model"  name="model" placeholder="Model number" value="<?php if(!empty($_GET['model'])) echo $_GET['model'] ?>">
                              <datalist id="modelss">
                                <?php if(!empty($dataasa['product_model'])){
                                 foreach (array_unique ($dataasa['product_model']) as $row) { ?>
                               <option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                                 <?php }} ?>
                            </datalist>
                        </div>
                        <!-- <div class="form-group">
                         <label for="">Search By ISBN</label>
                            <input type="text" class="form-control" name="isbn" id="isbn" list="isbns" placeholder="ISBN" value="<?php //if(!empty($_GET['isbn'])) echo $_GET['isbn'] ?>">
                             <datalist id="isbns">
                            <?php //if(!empty($dataasa['product_isbn'])){
                                 //foreach (array_unique ($dataasa['product_isbn']) as $row) { ?>
                               <option value="<?php //echo $row; ?>"><?php //echo $row; ?></option>
                                 <?php //}} ?>
                            </datalist>
                        </div> -->
                    </div>
                     <div class="col-lg-4">
                     <div class="form-group">
                            <label for="">Search by Rating</label>
                            <input type="text" class="form-control" name="rating" id="rating" placeholder="Rating" value="<?php if(!empty($_GET['rating'])) echo $_GET['rating'] ?>">
                        </div>

                        <div class="form-group">
                             <label for="">Search By Make (Manufacturer)</label>
                            <input type="type" class="form-control" list="manufacturers" name="manufacturer" id="manufacturer" placeholder="Make Name" value="<?php if(!empty($_GET['manufacturer'])) echo $_GET['manufacturer'] ?>">
                             <datalist id="manufacturers">
                            <?php if(!empty($dataasa['product_make'])){
                                 foreach (array_unique ($dataasa['product_make']) as $row) { ?>
                               <option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                                 <?php }} ?>
                            </datalist>
                        </div>

                        <div class="form-group">
                             <label for="">Search By Country</label>
                            <input type="text" class="form-control" list="countrys" name="country" id="country" placeholder="Country Name" value="<?php if(!empty($_GET['country'])) echo $_GET['country'] ?>">
                             <datalist id="countrys">
                                <?php if(!empty($dataasa['product_countrys'])){
                                    $product_countrys =  array_map('unserialize', array_unique(array_map('serialize', $dataasa['product_countrys'])));
                                foreach ($product_countrys as $row) {?>
                               <option value="<?php echo $row['country_id']; ?>" label="<?php echo $row['product_country']; ?>"><?php echo $row['product_country']; ?></option>
                                 <?php }} ?>
                            </datalist>
                        </div>
                        </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                             <label for="">Search By Product Type</label>
                            <input type="text" class="form-control" list="product_types" name="product_type" id="product_type" placeholder="Product Type" value="<?php if(!empty($_GET['product_type'])) echo $_GET['product_type'] ?>">
                            <datalist id="product_types">
                                <?php if(!empty($dataasa['product_type'])){
                                foreach (array_unique ($dataasa['product_type']) as $row) { ?>
                               <option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                                 <?php }} ?>
                            </datalist>
                        </div>
                         <div class="form-group">
                         <label for="">Search By Price Range</label>
                         <div class="row">
                            <div class="col-xs-6">
                            <input type="text" class="form-control" id="price_range_start" name="price_range_start" placeholder="Start Price" value="<?php if(!empty($_GET['price_range_start'])) echo $_GET['price_range_start'] ?>">
                            </div>
                            <div class="col-xs-6">
                            <input type="text" class="form-control" id="price_range_end" name="price_range_end" placeholder="End Price" value="<?php if(!empty($_GET['price_range_end'])) echo $_GET['price_range_end'] ?>">
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                             <label for="">Search By Country</label>
                            <input type="text" class="form-control" list="countrys" name="country" id="country" placeholder="Country Name" value="<?php if(!empty($_GET['country'])) echo $_GET['country'] ?>">
                             <datalist id="countrys">
                                <?php if(!empty($dataasa['product_countrys'])){
                                    $product_countrys =  array_map('unserialize', array_unique(array_map('serialize', $dataasa['product_countrys'])));
                                foreach ($product_countrys as $row) {?>
                               <option value="<?php echo $row['country_id']; ?>" label="<?php echo $row['product_country']; ?>"><?php echo $row['product_country']; ?></option>
                                 <?php }} ?>
                            </datalist>
                        </div>
                     </div>
                     <div class="row">
                         <div class="col-lg-4 col-lg-offset-4">
                         <button type="submit" class="btn btn-lg btn-primary" name="search" >
                         <i class="fa fa-search"></i> Search Now</button>
                         </div>
                     </div>
                 </form>
                </div>
                </div> <!-- AdvanceSearch -->

            </div>
        </div>

    </div>
    </div>
</div>
</div>

<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Live Marketplace - Selling Offers</h5>
    </div>
    <div class="ibox-content">

    <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
    <tr>
        <th>Listing End</th>
        <th>Rating</th>
        <th>MPN/ISBN</th>
        <th>Make</th>
        <th>Model</th>
        <th>Product Type</th>
        <th>Condition</th>
        <th>Price</th>
        <th>QTY</th>
        <th>Spec</th>
        <th>Country</th>
        <th>Options</th>
    </tr>
    </thead>
    <?php if($listing_buy){
        foreach ($listing_buy as $value) {?>
        <tr data-toggle="modal" data-target="#myModal5">
        <td><p><span data-countdown="<?php echo $value->listing_end_datetime; ?>"></span></p></td>
        <td><span class="fa fa-star" style="color:#FC3"></span> <span style="color:green">94</span></td>
        <td> <?php if(!empty($value->product_mpn_isbn)){ echo "MPN/ISBN: ".$value->product_mpn_isbn; } ?></td>
        <td><?php echo $value->product_make; ?></td>
        <td><?php echo $value->product_model; ?></td>
        <td><?php echo $value->product_type; ?></td>
        <td><?php echo $value->condition; ?></td>
        <td data-toggle="tooltip" data-placement="left" title="mouseover currency"><?php echo $value->unit_price; ?></td>
        <td><?php echo $value->total_qty; ?></td>
        <td><?php echo $value->spec; ?></td>
        <td>
        <span style="display:none"><?php echo $value->country ?></span>
        <img src="public/main/template/gsm/img/flags/<?php echo str_replace(' ', '_', $value->product_country) ?>.png" alt="<?php echo $value->product_country ?>" title="<?php echo $value->product_country ?>" />
        </td>
        <th>
        <a href="<?php echo base_url().'marketplace/listing_detail/'.$value->id ?>"><button type="button" class="btn btn-primary" style="font-size:10px">More Info</button></a></th>
    </tr>
       <?php }}else{
        ?>
        <th colspan="12"><center>No Such Listing Found </center></th><?php
        }?>
    </table>

    </div>
</div>
</div>
</div>

</div>
    
    


<?php } else {?>
<!-- Dummy Data Start -->
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">

            <div class="alert alert-info" style="margin:0 15px 15px">
                <p><i class="fa fa-info-circle"></i> Silver members and above will have access to the live marketplace upon launch. You can search by product category and make/model, if you are looking to narrow your results down further you can view the advanced search options. Any extra details you need can be found by clicking on the <i class="fa fa-question-circle cursor"></i> icons. This section of the marketplace displays all offers companies on GSMStockMarket have for sale and which you can choose to make an offer or . <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
            </div>
            
<div class="col-lg-12">
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Search</h5>
    </div>

<?php
$dataasa=array();
if(!empty($advance_search)):
foreach ($advance_search as $row) {
$dataasa['product_mpn'][]        = $row->product_mpn_isbn;
//$dataasa['product_isbn'][]       = $row->product_isbn;
$dataasa['product_make'][]       = $row->product_make ;
$dataasa['product_model'][]      = $row->product_model ;
$dataasa['product_type'][]       = $row->product_type;
$dataasa['product_countrys'][]   = array('country_id'=>$row->country_id,'product_country'=>$row->product_country);
}
endif;
?>

    <div class="ibox-content">
     <form action="<?php echo base_url('marketplace/buy'); ?>/<?php echo $offset ?>/" method="get" accept-charset="utf-8">
           <div class="row">
        	<div class="col-lg-3" style="padding-right:0">
            	<select name="lc" class="form-control" tabindex="1">
                	<option value="" selected="">All Categories</option>
                    <option>Accessories</option>
                    <option>Accessories > Batteries</option>
                    <option>Accessories > Bluetooth</option>
                    <option>Accessories > Car Kits</option>
                    <option>Accessories > Cables</option>
                    <option>Accessories > Chargers</option>
                    <option>Accessories > Cases</option>
                    <option>Accessories > Headphones</option>
                    <option>Accessories > Memory Cards</option>
                    <option>Accessories > Mobile Internet</option>
                    <option>Accessories > Sim Cards</option>
                    <option>Spare Parts</option>
                    <option>Spare Parts > Components</option>
                    <option>Spare Parts > Handsets</option>
                    <option>Spare Parts > Housings</option>
                    <option>Spare Parts > Keypads</option>
                    <option>Spare Parts > LCDs</option>
                    <option>Spare Parts > Main Boards</option>
                    <option>Spare Parts > Mobile Boxes</option>
                    <option>Spare Parts > Tools</option>
                </select>
            </div>
        	<div class="col-lg-5" style="padding-right:0">
               <select data-placeholder="Make and Model" class="chosen-select form-control" multiple tabindex="2">
                <option>Apple iPhone 3G</option>
                <option>Apple iPhone 3GS</option>
                <option>Apple iPhone 4</option>
                <option>Apple iPhone 4S</option>
                <option>Apple iPhone 5</option>
                <option>Apple iPhone 5C</option>
                <option>Apple iPhone 5S</option>
                <option>Apple iPhone 6</option>
                <option>Apple iPhone 6 Plus</option>
                <option>Samsung Galaxy S1 (i9000)</option>
                <option>Samsung Galaxy S2 (i9100)</option>
                <option>Samsung Galaxy S2 LTE (i9105)</option>
                <option>Samsung Galaxy S3 (i9300)</option>
                <option>Samsung Galaxy S3 LTE (i9305)</option>
                </select>
            </div>
        	<div class="col-lg-2">
            	<input type="submit" class="btn btn-primary btn-block" value="Search"/>
            </div>
        	<div class="col-lg-2">
                    <button class="btn btn-danger btn-block" type="button" data-toggle="collapse" data-target="#AdvanceSearch" aria-expanded="true" aria-controls="collapseExample">Advanced Search</button>
            </div>
           
        </div>
        </form>
        <div class="row">

            <div class="col-lg-12">

                <div id="AdvanceSearch"   <?php if(isset($_GET['search'])) echo 'class="collapse in" aria-expanded="true"'; else echo 'class="collapse"'; ?> style="margin-top:10px">
                <div class="well0 row">
                 <form action="<?php echo base_url('marketplace/buy'); ?>/<?php echo $offset ?>/" method="get" accept-charset="utf-8">

                    <div class="col-lg-2">
                        <div class="form-group">
                         <label for="">Selling Currency <i class="fa fa-question-circle cursor" data-toggle="modal" data-target="#currency" title="Click for more information"></i></label>
                            <select name="date" class="form-control" tabindex="1">
                                <option value="" selected="">Any</option>
                                <option>GBP &pound;</option>
                                <option>Euro &euro;</option>
                                <option>USD $</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-2">
                     	<div class="form-group">
                         <label for="">Item Condition <i class="fa fa-question-circle cursor" data-toggle="modal" data-target="#condition" title="Click for more information"></i></label>
                            <select name="condition" class="form-control" tabindex="3">
                                <option value="" selected="">Any</option>
                                  <option>New</option>
                                  <option>Used</option>
                                  <option>Refurbished</option>
                                  <option>Grade A</option>
                                  <option>Grade B</option>
                                  <option>Grade C</option>
                                  <option>Grade F</option>
                            </select>
                        </div>                        
                    </div>   
                        
                    <div class="col-lg-4">
                     	<div class="form-group">
                         <label for="">Seller Rating</label>
                                <div class="input-group">
                                    <input type="text" class="input-sm form-control" name="start" value="0"/>
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="input-sm form-control" name="end" value="100" />
                                </div>
                        </div>
                    </div>
                        
                     <div class="col-lg-4">
                     	<div class="form-group">
                         <label for="">Item Colour</label>
                            <select name="color" class="form-control" tabindex="3">
                                <option value="" selected="">Any</option>
                                  <option>Black</option>
                                  <option>Blue</option>
                                  <option>Brown</option>
                                  <option>Gold</option>
                                  <option>Green</option>
                                  <option>Grey</option>
                                  <option>Orange</option>
                                  <option>Pink</option>
                                  <option>Purple</option>
                                  <option>Red</option>
                                  <option>Silver</option>
                                  <option>White</option>
                                  <option>Yellow</option>
                            </select>
                        </div>
                    </div> 
                    
                    <div class="col-lg-4">                        
                         <div class="form-group">
                         <label for="">Unit Price Range</label>
                                <div class="input-group">
                                    <input type="text" class="input-sm form-control" name="start" value=""/>
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="input-sm form-control" name="end" value="" />
                                </div>
                        </div>
                    </div>      
                      
                     <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">MPN/ISBN</label>
                            <input type="type" class="form-control" id="mpn" list="mpns" name="mpn" placeholder="MPN/ISBN" value="<?php if(!empty($_GET['mpn'])) echo $_GET['mpn'] ?>">
                             <datalist id="mpns">
                            <?php if(!empty($dataasa['product_mpn'])){
                                 foreach (array_unique ($dataasa['product_mpn']) as $row) { ?>
                               <option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                                 <?php }} ?>
                            </datalist>
                        </div>
                    </div>
                        
                    <div class="col-lg-4">
                     	<div class="form-group">
                         <label for="">Seller Continent</label>
                            <select name="continent" class="form-control" id="continent">
                            <option value="" selected="selected">All Continents</option>
                            <option value="Africa">Africa</option>
                            <option value="Asia">Asia</option>
                            <option value="Europe">Europe</option>
                            <option value="Oceania">Oceania</option>
                            <option value="The Americas">The Americas</option>
                            </select>
                        </div>
                    </div>        
                      
                    <div class="col-lg-4">                    
                     	<div class="form-group">
                         <label for="">Seller Region</label>
                            <select class="form-control" id="regions" name="region">
                            <option value="">All Regions</option>
                            <option value="Australia and New Zealand">Australia and New Zealand</option>
                            <option value="Central Africa">Central Africa</option>
                            <option value="Central America">Central America</option>
                            <option value="Central Asia">Central Asia</option>
                            <option value="Eastern Africa">Eastern Africa</option>
                            <option value="Eastern Asia">Eastern Asia</option>
                            <option value="Eastern Europe">Eastern Europe</option>
                            <option value="Melanesia">Melanesia</option>
                            <option value="Micronesia">Micronesia</option>
                            <option value="North America">North America</option>
                            <option value="Northern Africa">Northern Africa</option>
                            <option value="Northern Europe">Northern Europe</option>
                            <option value="Polynesia">Polynesia</option>
                            <option value="South America">South America</option>
                            <option value="South-Eastern Asia">South-Eastern Asia</option>
                            <option value="Southern Africa">Southern Africa</option>
                            <option value="Southern Asia">Southern Asia</option>
                            <option value="Southern Europe">Southern Europe</option>
                            <option value="The Caribbean">The Caribbean</option>
                            <option value="Western Africa">Western Africa</option>
                            <option value="Western Asia">Western Asia</option>
                            <option value="Western Europe">Western Europe</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">                        
                        <div class="form-group">
                             <label for="">Seller Country</label>
                             <select class="form-control" id="countries" name="countries">
                              <option value="">All Countries</option>
                              <option value="1">Afghanistan</option>
                              <option value="2">Albania</option>
                              <option value="3">Algeria</option>
                              <option value="4">American Samoa</option>
                              <option value="5">Andorra</option>
                              <option value="6">Angola</option>
                              <option value="7">Anguilla</option>
                              <option value="8">Antigua and Barbuda</option>
                              <option value="9">Argentina</option>
                              <option value="10">Armenia</option>
                              <option value="11">Aruba</option>
                              <option value="12">Australia</option>
                              <option value="13">Austria</option>
                              <option value="14">Azerbaijan</option>
                              <option value="15">Bahamas</option>
                              <option value="16">Bahrain</option>
                              <option value="17">Bangladesh</option>
                              <option value="18">Barbados</option>
                              <option value="19">Belarus</option>
                              <option value="20">Belgium</option>
                              <option value="21">Belize</option>
                              <option value="22">Benin</option>
                              <option value="23">Bermuda</option>
                              <option value="24">Bhutan</option>
                              <option value="25">Bolivia</option>
                              <option value="26">Bosnia Herzegovina</option>
                              <option value="27">Botswana</option>
                              <option value="28">Brazil</option>
                              <option value="29">Brunei</option>
                              <option value="30">Bulgaria</option>
                              <option value="31">Burkina Faso</option>
                              <option value="32">Burma (Myanmar)</option>
                              <option value="33">Burundi</option>
                              <option value="34">Cambodia</option>
                              <option value="35">Cameroon</option>
                              <option value="36">Canada</option>
                              <option value="37">Cape Verde</option>
                              <option value="38">Cayman Islands</option>
                              <option value="39">Central African Republic</option>
                              <option value="40">Chad</option>
                              <option value="41">Chile</option>
                              <option value="42">China</option>
                              <option value="43">Christmas Island</option>
                              <option value="44">Cocos (Keeling) Islands</option>
                              <option value="45">Colombia</option>
                              <option value="46">Comoros</option>
                              <option value="47">Congo (Democratic Republic of the)</option>
                              <option value="48">Congo (Republic of the)</option>
                              <option value="49">Cook Islands</option>
                              <option value="50">Costa Rica</option>
                              <option value="51">Cote d'Ivoire</option>
                              <option value="52">Croatia</option>
                              <option value="53">Cuba</option>
                              <option value="54">Cyprus</option>
                              <option value="55">Czech Republic</option>
                              <option value="56">Denmark</option>
                              <option value="57">Djibouti</option>
                              <option value="58">Dominica</option>
                              <option value="59">Dominican Republic</option>
                              <option value="60">Ecuador</option>
                              <option value="61">Egypt</option>
                              <option value="62">El Salvador</option>
                              <option value="63">Equatorial Guinea</option>
                              <option value="64">Eritrea</option>
                              <option value="65">Estonia</option>
                              <option value="66">Ethiopia</option>
                              <option value="67">Falkland Islands</option>
                              <option value="68">Faroe Islands</option>
                              <option value="69">Fiji</option>
                              <option value="70">Finland</option>
                              <option value="71">France</option>
                              <option value="72">French Polynesia</option>
                              <option value="73">Gabon</option>
                              <option value="74">Gambia</option>
                              <option value="75">Georgia</option>
                              <option value="76">Germany</option>
                              <option value="77">Ghana</option>
                              <option value="78">Gibraltar</option>
                              <option value="79">Greece</option>
                              <option value="80">Greenland</option>
                              <option value="81">Grenada</option>
                              <option value="82">Guam</option>
                              <option value="83">Guatemala</option>
                              <option value="84">Guinea</option>
                              <option value="85">Guinea-Bissau</option>
                              <option value="86">Guyana</option>
                              <option value="87">Haiti</option>
                              <option value="88">Honduras</option>
                              <option value="89">Hong Kong</option>
                              <option value="90">Hungary</option>
                              <option value="91">Iceland</option>
                              <option value="92">India</option>
                              <option value="93">Indonesia</option>
                              <option value="94">Iran</option>
                              <option value="95">Iraq</option>
                              <option value="96">Ireland</option>
                              <option value="97">Israel</option>
                              <option value="98">Italy</option>
                              <option value="99">Jamaica</option>
                              <option value="100">Japan</option>
                              <option value="101">Jordan</option>
                              <option value="102">Kazakhstan</option>
                              <option value="103">Kenya</option>
                              <option value="104">Kiribati</option>
                              <option value="105">Korea North</option>
                              <option value="106">Korea South</option>
                              <option value="107">Kuwait</option>
                              <option value="108">Kyrgyzstan</option>
                              <option value="109">Laos</option>
                              <option value="110">Latvia</option>
                              <option value="111">Lebanon</option>
                              <option value="112">Lesotho</option>
                              <option value="113">Liberia</option>
                              <option value="114">Libya</option>
                              <option value="115">Liechtenstein</option>
                              <option value="116">Lithuania</option>
                              <option value="117">Luxembourg</option>
                              <option value="118">Macau</option>
                              <option value="119">Macedonia</option>
                              <option value="120">Madagascar</option>
                              <option value="121">Malawi</option>
                              <option value="122">Malaysia</option>
                              <option value="123">Maldives</option>
                              <option value="124">Mali</option>
                              <option value="125">Malta</option>
                              <option value="126">Marshall Islands</option>
                              <option value="127">Mauritania</option>
                              <option value="128">Mauritius</option>
                              <option value="129">Mayotte</option>
                              <option value="130">Mexico</option>
                              <option value="225">Missing Info</option>
                              <option value="131">Moldova</option>
                              <option value="132">Monaco</option>
                              <option value="133">Mongolia</option>
                              <option value="134">Montenegro</option>
                              <option value="135">Montserrat</option>
                              <option value="136">Morocco</option>
                              <option value="137">Mozambique</option>
                              <option value="138">Namibia</option>
                              <option value="139">Nauru</option>
                              <option value="140">Nepal</option>
                              <option value="141">Netherland Antilles</option>
                              <option value="142">Netherlands</option>
                              <option value="143">New Caledonia</option>
                              <option value="144">New Zealand</option>
                              <option value="145">Nicaragua</option>
                              <option value="146">Niger</option>
                              <option value="147">Nigeria</option>
                              <option value="148">Niue</option>
                              <option value="149">Norway</option>
                              <option value="150">Oman</option>
                              <option value="151">Pakistan</option>
                              <option value="152">Palau</option>
                              <option value="153">Panama</option>
                              <option value="154">Papua New Guinea</option>
                              <option value="155">Paraguay</option>
                              <option value="156">Peru</option>
                              <option value="157">Philippines</option>
                              <option value="158">Pitcairn</option>
                              <option value="159">Poland</option>
                              <option value="160">Portugal</option>
                              <option value="161">Puerto Rico</option>
                              <option value="162">Qatar</option>
                              <option value="163">Romania</option>
                              <option value="164">Russia</option>
                              <option value="165">Rwanda</option>
                              <option value="166">Saint Barthelemy</option>
                              <option value="167">Saint Helena</option>
                              <option value="168">Saint Kitts and Nevis</option>
                              <option value="169">Saint Lucia</option>
                              <option value="170">Saint Pierre and Miquelon</option>
                              <option value="171">Saint Vincent and Grenadines</option>
                              <option value="172">Samoa</option>
                              <option value="173">San Marino</option>
                              <option value="174">Sao Tome and Principe</option>
                              <option value="175">Saudi Arabia</option>
                              <option value="176">Senegal</option>
                              <option value="177">Serbia</option>
                              <option value="178">Seychelles</option>
                              <option value="179">Sierra Leone</option>
                              <option value="180">Singapore</option>
                              <option value="181">Slovakia</option>
                              <option value="182">Slovenia</option>
                              <option value="183">Solomon Islands</option>
                              <option value="184">Somalia</option>
                              <option value="185">South Africa</option>
                              <option value="186">Spain</option>
                              <option value="187">Sri Lanka</option>
                              <option value="188">Sudan</option>
                              <option value="189">Suriname</option>
                              <option value="190">Swaziland</option>
                              <option value="191">Sweden</option>
                              <option value="192">Switzerland</option>
                              <option value="193">Syria</option>
                              <option value="194">Taiwan</option>
                              <option value="195">Tajikistan</option>
                              <option value="196">Tanzania</option>
                              <option value="197">Thailand</option>
                              <option value="198">Timor-Leste</option>
                              <option value="199">Togo</option>
                              <option value="200">Tokelau</option>
                              <option value="201">Tonga</option>
                              <option value="202">Trinidad and Tobago</option>
                              <option value="203">Tunisia</option>
                              <option value="204">Turkey</option>
                              <option value="205">Turkmenistan</option>
                              <option value="206">Turks and Caicos Islands</option>
                              <option value="207">Tuvalu</option>
                              <option value="208">Uganda</option>
                              <option value="209">Ukraine</option>
                              <option value="210">United Arab Emirates</option>
                              <option value="211">United Kingdom</option>
                              <option value="212">United States</option>
                              <option value="213">Uruguay</option>
                              <option value="214">Uzbekistan</option>
                              <option value="215">Vanuatu</option>
                              <option value="216">Vatican City State</option>
                              <option value="217">Venezuela</option>
                              <option value="218">Vietnam</option>
                              <option value="219">Virgin Islands (British)</option>
                              <option value="220">Virgin Islands (US)</option>
                              <option value="221">Wallis and Futana</option>
                              <option value="222">Yemen</option>
                              <option value="223">Zambia</option>
                              <option value="224">Zimbabwe</option>
                              </select>
                        </div>
                    </div>
                        
                     </div>
                 </form>
                </div>
                </div> <!-- AdvanceSearch -->

            </div>
        </div>

    </div>
    </div>
</div>

<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Live Marketplace - Selling Offers</h5>
    </div>
    <div class="ibox-content">

    <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
    <tr>
        <th>Listing End</th>
        <th>Rating</th>
        <th>MPN/ISBN</th>
        <th>Make</th>
        <th>Model</th>
        <th>Product Type</th>
        <th>Condition</th>
        <th>Price</th>
        <th>QTY</th>
        <th>Spec</th>
        <th>Country</th>
        <th>Options</th>
    </tr>
    </thead>
        <tr>
        <td><p><span data-countdown="<?php echo date('m/d/Y', strtotime("+1 week")); ?>"></span></p></td>
        <td><span class="fa fa-star star-Silver"></span> <span class="label label-primary">94</span></td>
        <td>GH98-123456</td>
        <td>Samsung</td>
        <td>Galaxy S4 (i9500)</td>
        <td>LCD</td>
        <td>New</td>
        <td data-toggle="tooltip" data-placement="left" title="mouseover currency">12</td>
        <td>200</td>
        <td>UK</td>
        <td>
        <img src="public/main/template/gsm/img/flags/United_Kingdom.png" />
        </td>
        <th>
        <a href="marketplace/listing_detail/"><button type="button" class="btn btn-primary" style="font-size:10px">More Info</button></a></th>
    </tr>
        <tr>
        <td><p><span data-countdown="<?php echo date('m/d/Y', strtotime("+1 week 2 days")); ?>"></span></p></td>
        <td><span class="fa fa-star star-Silver"></span> <span class="label label-success">97</span></td>
        <td>GH98-123456</td>
        <td>Samsung</td>
        <td>Galaxy S4 (i9500)</td>
        <td>LCD</td>
        <td>New</td>
        <td data-toggle="tooltip" data-placement="left" title="mouseover currency">12</td>
        <td>200</td>
        <td>UK</td>
        <td>
        <img src="public/main/template/gsm/img/flags/United_Kingdom.png" />
        </td>
        <th>
        <a href="marketplace/listing_detail/"><button type="button" class="btn btn-primary" style="font-size:10px">More Info</button></a></th>
    </tr>
        <tr>
        <td><p><span data-countdown="<?php echo date('m/d/Y', strtotime("+2 days")); ?>"></span></p></td>
        <td><span class="fa fa-star star-Silver"></span> <span class="label label-primary">83</span></td>
        <td>A1586</td>
        <td>Apple</td>
        <td>iPhone 6</td>
        <td>Handset</td>
        <td>Refurbished</td>
        <td data-toggle="tooltip" data-placement="left" title="mouseover currency">98</td>
        <td>200</td>
        <td>EURO</td>
        <td>
        <img src="public/main/template/gsm/img/flags/Germany.png" />
        </td>
        <th>
        <a href="marketplace/listing_detail/"><button type="button" class="btn btn-primary" style="font-size:10px">More Info</button></a></th>
    </tr>
        <tr>
        <td><p><span data-countdown="<?php echo date('m/d/Y', strtotime("+2 days")); ?>"></span></p></td>
        <td><span class="fa fa-star star-Silver"></span> <span class="label label-warning">75</span></td>
        <td>A1586</td>
        <td>Apple</td>
        <td>iPhone 6</td>
        <td>Handset</td>
        <td>Refurbished</td>
        <td data-toggle="tooltip" data-placement="left" title="mouseover currency">98</td>
        <td>200</td>
        <td>EURO</td>
        <td>
        <img src="public/main/template/gsm/img/flags/Germany.png" />
        </td>
        <th>
        <a href="marketplace/listing_detail/"><button type="button" class="btn btn-primary" style="font-size:10px">More Info</button></a></th>
    </tr>
        <tr>
        <td><p><span data-countdown="<?php echo date('m/d/Y', strtotime("+2 days")); ?>"></span></p></td>
        <td><span class="fa fa-star star-Silver"></span> <span class="label label-danger">45</span></td>
        <td>A1586</td>
        <td>Apple</td>
        <td>iPhone 6</td>
        <td>Handset</td>
        <td>Refurbished</td>
        <td data-toggle="tooltip" data-placement="left" title="mouseover currency">98</td>
        <td>200</td>
        <td>EURO</td>
        <td>
        <img src="public/main/template/gsm/img/flags/Germany.png" />
        </td>
        <th>
        <a href="marketplace/listing_detail/"><button type="button" class="btn btn-primary" style="font-size:10px">More Info</button></a></th>
    </tr>
        <tr>
        <td><p><span data-countdown="<?php echo date('m/d/Y', strtotime("+2 days")); ?>"></span></p></td>
        <td><span class="fa fa-star star-Gold"></span> <span class="label label-success">98</span></td>
        <td>A1586</td>
        <td>Apple</td>
        <td>iPhone 6</td>
        <td>Handset</td>
        <td>Refurbished</td>
        <td data-toggle="tooltip" data-placement="left" title="mouseover currency">98</td>
        <td>200</td>
        <td>US</td>
        <td>
        <img src="public/main/template/gsm/img/flags/United_States.png" />
        </td>
        <th>
        <a href="marketplace/listing_detail/"><button type="button" class="btn btn-primary" style="font-size:10px">More Info</button></a></th>
    </tr>
        <tr>
        <td><p><span data-countdown="<?php echo date('m/d/Y', strtotime("+2 days")); ?>"></span></p></td>
        <td><span class="fa fa-star star-Gold"></span> <span class="label label-success">98</span></td>
        <td>A1586</td>
        <td>Apple</td>
        <td>iPhone 6</td>
        <td>Handset</td>
        <td>Refurbished</td>
        <td data-toggle="tooltip" data-placement="left" title="mouseover currency">98</td>
        <td>200</td>
        <td>ASIA</td>
        <td>
        <img src="public/main/template/gsm/img/flags/China.png" />
        </td>
        <th>
        <a href="marketplace/listing_detail/"><button type="button" class="btn btn-primary" style="font-size:10px">More Info</button></a></th>
    </tr>
        <tr>
        <td><p><span style="color:red" data-countdown="<?php echo date('m/d/Y', strtotime("+1 day")); ?>"></span></p></td>
        <td><span class="fa fa-star star-Gold"></span> <span class="label label-success">100</span></td>
        <td>A1586</td>
        <td>Apple</td>
        <td>iPhone 6</td>
        <td>Handset</td>
        <td>Refurbished</td>
        <td data-toggle="tooltip" data-placement="left" title="mouseover currency">98</td>
        <td>200</td>
        <td>EURO</td>
        <td>
        <img src="public/main/template/gsm/img/flags/France.png" />
        </td>
        <th>
        <a href="marketplace/listing_detail/"><button type="button" class="btn btn-primary" style="font-size:10px">More Info</button></a></th>
    </tr>
    </table>

    </div>
</div>
</div>
</div>

</div>

<?php } ?> 
<!-- Daniel Added End -->

    

<!-- Data Tables -->
<link href="public/main/template/core/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="public/main/template/core/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
<link href="public/main/template/core/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

<!-- Multi Select -->
<link href="public/main/template/core/css/plugins/chosen/chosen.css" rel="stylesheet">

<!-- Data Tables -->
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/jquery.dataTables.js"></script>
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.responsive.js"></script>
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.tableTools.min.js"></script>

<!-- Chosen -->
<script src="public/main/template/core/js/plugins/chosen/chosen.jquery.js"></script>


<!-- Page-Level Scripts -->
<script type="text/javascript">
$(document).ready(function() {
    <?php if($listing_buy): ?>
    $('.dataTables-example').dataTable({
        responsive: true,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "public/main/template/core/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
        }
    });
    <?php endif; ?>
	/* multi select */
	var config = {
        '.chosen-select'           : {search_contains:true},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }			

});
</script>


<style>
body.DTTT_Print { background: #fff;}
.DTTT_Print #page-wrapper {margin: 0;background:#fff;}
button.DTTT_button, div.DTTT_button, a.DTTT_button {border: 1px solid #e7eaec;background: #fff;color: #676a6c;box-shadow: none;padding: 6px 8px;}
button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {border: 1px solid #d2d2d2;background: #fff;color: #676a6c;box-shadow: none;padding: 6px 8px;}
.dataTables_filter label {margin-right: 5px;}


/* chosen css override */
.chosen-container-multi .chosen-choices li.search-field input[type="text"] {font-family:inherit;font-size:14px}
.chosen-container-multi .chosen-choices {border-radius:5px;border:1px solid #e5e6e7}
.chosen-container-multi .chosen-choices li.search-choice {color:#FFF;background:#1ab394}

i.cursor:hover {cursor:pointer}

</style>
<script src="public/admin/js/jquery.countdown.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $('[data-countdown]').each(function() {
       var $this = $(this), finalDate = $(this).data('countdown');
       $this.countdown(finalDate, function(event) {
         $this.html(event.strftime('%Dd %Hh %Mm %Ss'));
       });
     });
});
</script>


<!-- Modal Data Seller Currency -->
<div class="modal inmodal fade" id="currency" tabindex="-1" role="dialog"  aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Selling Currency</h4>
            <small class="font-bold">Currencies available</small>
        </div>

        <div class="modal-body">
          <p>When a seller has an item for sale they specify the currency they wish the item to be paid in. When you make an offer it will be in the currency they chose, but we will display a conversion of the price in the other currencies also on the listing which is managed by XE.com as a guide to help make trading easier for you.</p>
          <p>Currencies traded on this website are in <strong>GBP &pound;</strong>, <strong>Euro &euro;</strong> and <strong>USD $</strong></p>
        </div>
	</div>
</div>
</div>

<!-- Modal Data Item Condition -->
<div class="modal inmodal fade" id="currency" tabindex="-1" role="dialog"  aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Item Condition</h4>
            <small class="font-bold">Condition categories</small>
        </div>

        <div class="modal-body">
          <p><strong>New</strong> - An unused brand new product in mint condition.</p>
          <p><strong>Refurbished</strong> - A product that has been used/repaired to near mint condition, almost brand new.</p>
          <p><strong>Used</strong> - The product has been used but in great condition and in perfect working order.</p>
          <p><strong>Grade A</strong> - Not new, but in excellent condition.</p>
          <p><strong>Grade B</strong> - Good condition, may have light marks and scratches from minor user.</p>
          <p><strong>Grade C</strong> - Fair condition, will have marks and scratches from heavier use.</p>
          <p><strong>Grade F</strong> - Fault and/or broken condition, may have cracks.</p>
        </div>
	</div>
</div>
</div>

<!-- Modal Data Seller Rating -->
<div class="modal inmodal fade" id="currency" tabindex="-1" role="dialog"  aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">User Rating</h4>
            <small class="font-bold">Rating System</small>
        </div>

        <div class="modal-body">
          <p>The <strong>Rating System</strong> is decided upon a number of factors involving previous buying and selling of the users accounts. We measure their rating on </p>
        </div>
	</div>
</div>
</div>