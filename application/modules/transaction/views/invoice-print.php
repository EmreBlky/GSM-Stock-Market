
<!DOCTYPE html>
<html>

<head>
    <base href="<?php echo $base; ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GSM - Transaction: Invoice Print</title>

    <link href="public/main/template/core/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/main/template/core/font/css/font-awesome.css" rel="stylesheet">

    <link href="public/main/template/core/css/animate.css" rel="stylesheet">
    <link href="public/main/template/core/css/style.css" rel="stylesheet">

</head>

<body class="white-bg">


                <div class="wrapper wrapper-content p-xl">
                    <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>From:</h5>
                                    	<img src="public/main/template/gsm/images/gsm.png" class="img-responsive" style="max-width:200px;margin-bottom:20px"/>
                                    <address>
                                        <strong>GSMStockMarket.com Limited</strong><br>
                                        The Old Dairy<br>
                                        Hazlemere, High Wycombe<br>
                                        Buckinghamshire, HP15 7LG<br>
                                        United Kingdom<br>                                        
                                        <abbr title="Phone">P:</abbr> +44 (0)1494 717321
                                    </address>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <h4>Invoice No.</h4>
                                    <h4 class="text-navy"><?php echo $transaction->invoice; ?></h4>
                                    <span>To:</span>
                                    <address>
                                        <strong><?php echo $this->member_model->get_where($transaction->buyer_id)->firstname.''.$this->member_model->get_where($transaction->buyer_id)->lastname ?></strong><br>
                                        <strong><?php echo $this->company_model->get_where($this->member_model->get_where($transaction->buyer_id)->company_id)->company_name; ?></strong><br>
                                        <?php echo $this->company_model->get_where($this->member_model->get_where($transaction->buyer_id)->company_id)->address_line_1; ?>,<br/>
                                        <?php 
                                        $add_2 = $this->company_model->get_where($this->member_model->get_where($transaction->buyer_id)->company_id)->address_line_2;                                        
                                        
                                        if(!empty($add_2)){
                                        ?>
                                        <?php echo  $add_2; ?>,<br />
                                        <?php
                                            }
                                        ?>
                                        <?php echo $this->company_model->get_where($this->member_model->get_where($transaction->buyer_id)->company_id)->town_city; ?>,<br/> 
                                        <?php echo $this->company_model->get_where($this->member_model->get_where($transaction->buyer_id)->company_id)->county; ?>.<br />
                                        <?php echo $this->company_model->get_where($this->member_model->get_where($transaction->buyer_id)->company_id)->post_code; ?>.<br />
                                        <?php echo $this->country_model->get_where($this->company_model->get_where($this->member_model->get_where($transaction->buyer_id)->company_id)->country)->country; ?><br />
                                        <abbr title="Phone">P:</abbr> <?php echo $this->member_model->get_where($transaction->buyer_id)->phone_number;?><br />
                                        <?php
                                        $vat = $this->company_model->get_where($this->member_model->get_where($transaction->buyer_id)->company_id)->vat_tax;
                                                
                                                if(!empty($vat)) {
                                        ?>
                                                    VAT Number <?php echo $this->company_model->get_where($this->member_model->get_where($transaction->buyer_id)->company_id)->vat_tax;?>     
                                        <?php
                                                }
                                        ?>
                                    </address>
                                    <p>
                                        <span><strong>Invoice Date:</strong> <?php echo date('F j, Y', strtotime($transaction->date));?></span>
                                    </p>
                                </div>
                            </div>

                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><div><strong><?php echo $transaction->item;?></strong></div>
                                            <small><?php echo $transaction->item_description;?></small></td>
                                        <td><?php echo $transaction->quantity;?></td>
                                        <td>&pound;<?php echo number_format($transaction->amount, 2,".",",");;?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>TOTAL :</strong></td>
                                    <td>&pound;
                                        <?php 
                                                                                
                                        $total_amount = $transaction->amount*$transaction->quantity;
                                        
                                        echo number_format($transaction->amount, 2,".",",");
                                        
                                        ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="well m-t">
                            <p class="small"><strong>Remember to add your invoice number to your reference when paying by bank transfer</strong><br  />
                            Amount <strong>must</strong> be paid in GBP &pound;<br /><br/>
							<strong>Account Name:</strong> GSM Stock Market.com Ltd<br />
                            <strong>IBAN:</strong> GB73 BARC 2040 7153 1834 24<br />
                            <strong>SWIFTBIC:</strong> BARCGB22<br />
                            <strong>Account no:</strong> 53183424<br />
                            <strong>Sort Code:</strong> 20-40-71<br />
                            Barclays Bank. 12 Station Approach, Gerrards Cross, Bucks. SL9 8PP. UK.</p>
                            </div>
                            
                            <div class="text-right">
                        		<a href="transaction/invoice_print" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Transaction </a>
                            </div>
                        </div>
                </div>
            </div>

</div>
</body>
</html>


    <script type="text/javascript">
        window.print();
    </script>