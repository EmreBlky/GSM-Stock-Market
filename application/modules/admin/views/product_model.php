<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
        <li class="active">
            <strong>Product model</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
</div>


<div class="wrapper wrapper-content">

<div class="row">
<div class="col-lg-8">
<?php msg_alert(); ?> 
    <div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Product model</h5>
    </div>
    <div class="ibox-content">
    <br>
        <form method="post" action="<?php echo current_url()?>"  class="validation form-horizontal" />
        <input type="hidden" name="product" value="1">
        <div class="form-group"><label class="col-md-3 control-label">Product model</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="Mention model" name="product_model" />
                <?php echo form_error('product_model'); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
                <button class="btn btn-warning" type="submit">Save Product model</button>
            </div>
        </div>
       </form>
     </div>

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Product model</h5>
        </div>
        <div class="ibox-content">

        <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
        <thead>
        <tr>
            <th>Id</th>
            <th>Product Model</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($product_model)){ ?>
            <form method="post" action="<?php echo current_url()?>"  class="validation form-horizontal">
            <?php foreach ($product_model as $row) { ?>
                <tr>
                <td><?php if(!empty($row->id)){ echo '#'.$row->id; } ?></td>
                <td><input type="text" name="product_model_<?php echo $row->id; ?>" value="<?php if(!empty($row->product_model)) echo $row->product_model;  ?>"/></td>
                <th>
                <button type="submit" name="model_submit" class="btn btn-primary" value="<?php echo $row->id;  ?>">update</button>
                <a href="<?php echo base_url().'admin/product_model/'.$row->id;  ?>" onclick="confirm('Are your sure');"  class="btn btn-danger" >Delete</a>
                </th>
                </tr>
            <?php } ?>
                
            </form>
        <?php } else{?>
        <tr><td colspan="4"><center><h3>No Product model are available.</h3></center></td></tr>
        <?php } ?>
        </tbody>
        </table>
        </div>
    </div>



  </div>
</div>
</div>



</div>
