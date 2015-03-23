<div class="modal inmodal fade" id="feedback" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Leave Feedback</h4>
                <small class="font-bold"><strong >Feedback</strong> for <?php echo $member; ?></small>
            </div>
            <div class="modal-body">
            <div class="row">
            <form>
                  <input type="text" class="form-control" placeholder="Summary of your thoughts and experience for this user" />
              <div class="form-group" style="margin-top:15px">
                  <label class="col-md-5 control-label" style="margin-top:10px;text-align:right">Communication</label>
                  <div class="col-md-7">
                      <input class="rb-rating">
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-5 control-label" style="margin-top:10px;text-align:right">Shipping</label>
                  <div class="col-md-7">
                      <input class="rb-rating">
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-5 control-label" style="margin-top:10px;text-align:right">Quality of Goods</label>
                  <div class="col-md-7">
                      <input class="rb-rating">
                  </div>
              </div>
            </form>  
            </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Leave Feedback</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

