<?php
/**
 * Created by Naveed-ul-Hassan Malik
 * Date: 5/11/2015
 * Time: 11:21 AM
 */

namespace nvd\custom\libraries;

require_once __DIR__ . "/mandrill/Mandrill.php";

class Mailer extends \Mandrill{
    public $apiKey = "iWXEJKCA9DGqgNXxP__oJA"; //naveed.malik@dynamologic.com
    public $fromEmail = "test@nvd.com";

    public function __construct(){
        parent::__construct($this->apiKey);
    }

    public static function send( $to, $subject, $body, $from_name='', $from_email=''){
        $mailer = new Mailer();
        if(!$to){ $to = "naveed.malik@dynamologic.com"; }
        if(!$from_email){ $from_email = $mailer->fromEmail; }
        if(!$from_name){ $from_name = "Testing from ".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; }
        $message = array(
            'subject' => $subject,
            'html' => $body,
            'from_email' => $from_email,
            'from_name' => $from_name,
            'to' => array(
                array(
                    'email' => $to,
                    'name' => $to,
                    'type' => 'to'
                )
            ),
        );
        $mailer->messages->send($message);
    }
}