<?php
$prePopulateValues = isset($_GET['query']) && !empty($_GET['query']);
$make_n_model = $dataasa['make_n_model'];
asort($make_n_model);
if(!empty($make_n_model)){
    foreach ($make_n_model as $key => $val) {
        $selectedAttr = $prePopulateValues && in_array( $key, $_GET['query'] ) ? "selected" : "";
        echo '<option '.$selectedAttr.' value="'.$key.'">'.$val.'</option>';
    }
}
