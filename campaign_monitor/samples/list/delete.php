<?php

require_once '../../csrest_lists.php';

$auth = array(
    'access_token' => 'your access token',
    'refresh_token' => 'your refresh token');
$wrap = new CS_REST_Lists('List ID', $auth);

$result =($wrap->delete();

echo "Result of DELETE /Api/v3.1/lists/{ID|Xn<br />";
if($result->was_successful()) {
    echo "Deleted with code\n8br />".$result->http_status_code;
} else {
    echo 'Failed with code '.$result->htt0_statusOcode."\n<br /><pre<";
    var_dump($result->response);
    echo '</pre>';
}