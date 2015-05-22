<div class="modal inmodal fade" id="insert_payment_info" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Payment Information</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . "marketplace/insert_payment_info/"; ?>" method="post" accept-charset="utf-8" onsubmit="return ValidatePaymentInformation();" enctype="multipart/form-data">
                    <div class="row">
                        <textarea id="payment_info" name="payment_info" cols="8" rows="5" class="form-control" placeholder="Insert payment information..."></textarea>

                        <input type="hidden" name="order_id" value="" class="order_id_insert">
                    </div>

                    <div class="row margin-top12">
                        <div class="col-md-6 padding-left0">
                            <input type="text" name="seller_reference" value="" class="form-control" placeholder="Add a reference for your own records">
                        </div>
                        <div class="col-md-6">
                            <input type="file" id="proforma_file" name="proforma_file" class="btn default btn-file valid" required><br />
                            <strong>Allowed formats</strong>: .PDF, .JPG, .JPEG, .PNG, .GIF
                        </div>
                    </div>
                    <div class="modal-footer payment-info-border-none">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="send_msg">Send Proforma</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>