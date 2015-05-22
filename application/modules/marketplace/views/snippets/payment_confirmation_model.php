<div class="modal inmodal fade" id="payment_confirm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Payment Confirmation & Add Tracking / shipping Information</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . "marketplace/payment_confirm/"; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="row">
                        <label><input type="checkbox" name="payment_confirm" required> Confirm Payment received successfully.</label>
                        <textarea name="shipping_info" cols="8" rows="5" class="form-control" placeholder="Insert Tracking / Shipping information." required></textarea>
                        <input type="hidden" name="order_id" value="" class="order_id_insert">
                    </div>
                    <div class="row">
                        <label for="tracking_file">Add a Tracking Information File (Optional)</label>
                        <input type="file" id="tracking_file" name="tracking_file" class="btn default btn-file valid"><br />
                        <strong>Allowed formats</strong>: .PDF, .JPG, .JPEG, .PNG, .GIF</div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Tracking / Shipment Information</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>