<?php if($active == 'add_company') {?>    

<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li><a href="admin/">Overview</a></li>
        <li class="active"><a href="admin/add_company">Add Company</a></li>
        <li><a href="admin/bulk_import">Bulk Import Emails</a></li>
        <li><a href="admin/export">Export</a></li>
    </ul>
</div>

<?php } elseif($active == 'bulk_import') {?>    

<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li><a href="admin/">Overview</a></li>
        <li><a href="admin/add_company">Add Company</a></li>
        <li class="active"><a href="admin/bulk_import">Bulk Import Emails</a></li>
        <li><a href="admin/export">Export</a></li>
    </ul>
</div>

<?php } elseif($active == 'export') {?>    

<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li><a href="admin/">Overview</a></li>
        <li><a href="admin/add_company">Add Company</a></li>
        <li><a href="admin/bulk_import">Bulk Import Emails</a></li>
        <li class="active"><a href="admin/export">Export</a></li>
    </ul>
</div>

<?php } else { ?>

<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class="active"><a href="admin/">Overview</a></li>
        <li><a href="admin/add_company">Add Company</a></li>
        <li><a href="admin/bulk_import">Bulk Import Emails</a></li>
        <li><a href="admin/export">Export</a></li>
    </ul>
</div>

<?php } ?>
