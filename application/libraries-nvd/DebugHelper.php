<?php
/**
 * Created by Naveed ul Hassan
 * Date: 4/16/2015
 * Time: 3:53 PM
 */

namespace nvd\custom\libraries;

function pr($obj , $label=''){
    echo "<hr><b>".$label.":</b>";
    echo "<pre>";
    print_r($obj);
    echo "</pre>";
}
function pEcho($str){
    echo "<p>$str</p>";
}
function prpost(){ pr( $_POST , 'POST Array' ); }
function prget(){ pr( $_GET , 'GET Array' ); }
function prses(){ pr( $_SESSION , 'SESSION Array' ); }
function prser(){ pr( $_SERVER , 'SERVER Array' ); }

