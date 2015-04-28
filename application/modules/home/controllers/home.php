<?php
class Home extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        //unset($data_activity);
        
    }

    function index()
    {
        if ( ! $this->session->userdata('logged_in') )
        { 
            redirect('login');
        }
        
        
         $this->load->model('activity/activity_model', 'activity_model');
         $data_activity = array(
                                'activity' => 'Home',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));

        $data['main'] = 'home';        
        $data['title'] = 'GSM - Home';        
        $data['page'] = 'index';

        $this->load->module('templates');
        $this->templates->page($data);

    }
    
    function email()
    {
        $this->load->module('emails');
        $config = Array(
                                'protocol' => 'smtp',
                                'smtp_host' => 'ssl://secure.gsmstockmarket.com',
                                'smtp_port' => 465,
                                'smtp_user' => 'noreply@gsmstockmarket.com',
                                'smtp_pass' => 'ehT56.l}iW]I2ba3f0',
                                'charset' => 'utf-8',
                                'wordwrap' => TRUE,
                                'newline' => "\r\n",
                                'crlf'    => ""

                            );
                
                $this->load->library('email', $config);
                //$this->load->library('email');
                //$this->email->newline = "\r\n";
                //$this->email->crlf = "\r\n";
                $this->email->set_mailtype("html");
                $email_body = '
                                <style>
                                /* -------------------------------------
                                GLOBAL
                                A very basic CSS reset
                                ------------------------------------- */
                                * {
                                margin: 0;
                                padding: 0;
                                font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                                box-sizing: border-box;
                                font-size: 14px;
                                }
                                img {
                                max-width: 100%;
                                }
                                body {
                                -webkit-font-smoothing: antialiased;
                                -webkit-text-size-adjust: none;
                                width: 100% !important;
                                height: 100%;
                                line-height: 1.6;
                                }

                                table td {
                                vertical-align: top;
                                }
                                /* -------------------------------------
                                BODY & CONTAINER
                                ------------------------------------- */
                                body {
                                background-color: #f6f6f6;
                                }
                                .body-wrap {
                                background-color: #f6f6f6;
                                width: 100%;
                                }
                                .container {
                                display: block !important;
                                max-width: 600px !important;
                                margin: 0 auto !important;
                                /* makes it centered */
                                clear: both !important;
                                }
                                .content {
                                max-width: 600px;
                                margin: 0 auto;
                                display: block;
                                padding: 20px;
                                }
                                /* -------------------------------------
                                HEADER, FOOTER, MAIN
                                ------------------------------------- */
                                .main {
                                background: #fff;
                                border: 1px solid #e9e9e9;
                                border-radius: 3px;
                                }
                                .content-wrap {
                                padding: 20px;
                                }
                                .content-block {
                                padding: 0 0 20px;
                                }
                                .header {
                                width: 100%;
                                margin-bottom: 20px;
                                }
                                .footer {
                                width: 100%;
                                clear: both;
                                color: #999;
                                padding: 20px;
                                }
                                .footer a {
                                color: #999;
                                }
                                .footer p, .footer a, .footer unsubscribe, .footer td {
                                font-size: 12px;
                                }
                                /* -------------------------------------
                                TYPOGRAPHY
                                ------------------------------------- */
                                h1, h2, h3 {
                                font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
                                color: #000;
                                margin: 40px 0 0;
                                line-height: 1.2;
                                font-weight: 400;
                                }
                                h1 {
                                font-size: 32px;
                                font-weight: 500;
                                }
                                h2 {
                                font-size: 24px;
                                }
                                h3 {
                                font-size: 18px;
                                }
                                h4 {
                                font-size: 14px;
                                font-weight: 600;
                                }
                                p, ul, ol {
                                margin-bottom: 10px;
                                font-weight: normal;
                                }
                                p li, ul li, ol li {
                                margin-left: 5px;
                                list-style-position: inside;
                                }
                                /* -------------------------------------
                                LINKS & BUTTONS
                                ------------------------------------- */
                                a {
                                color: #1ab394;
                                text-decoration: underline;
                                }
                                .btn-primary {
                                text-decoration: none;
                                color: #FFF;
                                background-color: #1ab394;
                                border: solid #1ab394;
                                border-width: 5px 10px;
                                line-height: 2;
                                font-weight: bold;
                                text-align: center;
                                cursor: pointer;
                                display: inline-block;
                                border-radius: 5px;
                                text-transform: capitalize;
                                }
                                .btn-success {
                                text-decoration: none;
                                color: #FFF;
                                background-color: #1c84c6;
                                border: solid #1c84c6;
                                border-width: 5px 10px;
                                line-height: 2;
                                font-weight: bold;
                                text-align: center;
                                cursor: pointer;
                                display: inline-block;
                                text-transform: capitalize;
                                }
                                /* -------------------------------------
                                OTHER STYLES THAT MIGHT BE USEFUL
                                ------------------------------------- */
                                .last {
                                margin-bottom: 0;
                                }
                                .first {
                                margin-top: 0;
                                }
                                .aligncenter {
                                text-align: center;
                                }
                                .alignright {
                                text-align: right;
                                }
                                .alignleft {
                                text-align: left;
                                }
                                .clear {
                                clear: both;
                                }
                                /* -------------------------------------
                                ALERTS
                                Change the class depending on warning email, good email or bad email
                                ------------------------------------- */
                                .alert {
                                font-size: 16px;
                                color: #fff;
                                font-weight: 500;
                                padding: 20px;
                                text-align: center;
                                border-radius: 3px 3px 0 0;
                                }
                                .alert a {
                                color: #fff;
                                text-decoration: none;
                                font-weight: 500;
                                font-size: 16px;
                                }
                                .alert.alert-warning {
                                background: #f8ac59;
                                }
                                .alert.alert-bad {
                                background: #ed5565;
                                }
                                .alert.alert-good {
                                background: #1ab394;
                                }
                                /* -------------------------------------
                                INVOICE
                                Styles for the billing table
                                ------------------------------------- */
                                .invoice {
                                margin: 40px auto;
                                text-align: left;
                                width: 80%;
                                }
                                .invoice td {
                                padding: 5px 0;
                                }
                                .invoice .invoice-items {
                                width: 100%;
                                }
                                .invoice .invoice-items td {
                                border-top: #eee 1px solid;
                                }
                                .invoice .invoice-items .total td {
                                border-top: 2px solid #333;
                                border-bottom: 2px solid #333;
                                font-weight: 700;
                                }
                                /* -------------------------------------
                                RESPONSIVE AND MOBILE FRIENDLY STYLES
                                ------------------------------------- */
                                @media only screen and (max-width: 640px) {
                                h1, h2, h3, h4 {
                                font-weight: 600 !important;
                                margin: 20px 0 5px !important;
                                }
                                h1 {
                                font-size: 22px !important;
                                }
                                h2 {
                                font-size: 18px !important;
                                }
                                h3 {
                                font-size: 16px !important;
                                }
                                .container {
                                width: 100% !important;
                                }
                                .content, .content-wrap {
                                padding: 10px !important;
                                }
                                .invoice {
                                width: 100% !important;
                                }
                                }
                                </style>
                                <table class="body-wrap">
                                <tr>
                                <td></td>
                                <td class="container" width="600">
                                <div class="content">
                                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                <td class="content-wrap">
                                <table  cellpadding="0" cellspacing="0">
                                <tr>
                                <td>
                                <img class="img-responsive" src="<?php echo $base; ?>public/main/template/gsm/images/email/header.png"/>
                                </td>
                                </tr>
                                <tr>
                                <td class="content-block">
                                <h3>Your account is now activated!</h3>
                                </td>
                                </tr>
                                <tr>
                                <td class="content-block">
                                <p>Welcome <?php echo $name; ?>,</p>
                                <p>Login now to access your account and start using the platform.<p/>
                                <p>Remember to complete your personal and company profile contact details information, upload your logos and images and ensure all your business trading sectors are completed, this will help other members get a better understanding about your business and start generating more enquiries from new suppliers and customers.</p>
                                </td>
                                </tr>
                                <tr>
                                <td class="content-block aligncenter">
                                <h3 style="margin-top:0">Your Password is</h3>
                                <p class="btn-success"><?php echo $password; ?></p>
                                </td>
                                </tr>
                                <tr>
                                <td class="content-block">
                                <p>To access your account visit <a href="<?php echo $base; ?>login">https://secure.gsmstockmarket.com/login</a> and sign in with your email on signup and the password given to you above.</p>
                                </td>
                                </tr>
                                <tr>
                                <td class="content-block">
                                <p>If you need any assistance please call us on +44 (0)1494 717321 or use the online ticketing customer support within your account and we’ll be happy to help you.</p>
                                <p>Many Thanks,<br />
                                GSMStockMarket Team</p>
                                </td>
                                </tr>
                                </table>
                                </td>
                                </tr>
                                </table></div>
                                </td>
                                <td></td>
                                </tr>
                                </table>
                                ';
                
                
                $this->email->from('info@gsmstockmarket.com', 'Support Team');

                $list = array('info@imarveldesign.co.uk');
                $this->email->to($list);
                $this->email->subject('Your Account has been upgraded');
                $this->email->message($email_body);

                $this->email->send();
                echo $this->email->print_debugger();
                
                
        
    }
            

    function confirmation($var = NULL)
    {

        $data['main'] = 'home';        
        $data['title'] = 'GSM - Confirmation';        
        $data['page'] = 'cofirm';

        $this->load->module('templates');
        $this->templates->page($data);

    }  
    
    function test()
    {
        echo '<pre>';
        print_r($_POST);

    }

}