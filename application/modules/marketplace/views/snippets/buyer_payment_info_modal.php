
<div class="modal inmodal fade" id="payment_done" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Payment Status</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . "marketplace/payment_done/"; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="row">
                        <?php if ($value->payment_detail) { ?><h5>Payment Info - <?php echo $value->payment_detail; ?></h5> <?php } ?>
                    </div>

                    <div class="row margin-top12">
                        <div class="col-md-6 padding-left0">
                            <label><input type="checkbox" name="payment_done" value="" required> Yes I have done payment.</label>
                            <input type="hidden" name="order_id" value="" class="order_id_insert">
                        </div>
                        <div class="col-md-6">
                            <label for="bank_payment_file">Payment Receipt (Optional)</label>
                            <input type="file" id="bank_payment_file" name="bank_payment_file" class="btn default btn-file valid">
                        </div>
                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary" id="send_msg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
