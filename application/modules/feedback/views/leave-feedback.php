      <div class="modal inmodal fade" id="feedback" tabindex="-1" role="dialog"  aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <h4 class="modal-title">Leave Feedback</h4>
                      <small class="font-bold"><strong >Feedback</strong> for GSMStockMarket.com Limited</small>
                  </div>
                  <div class="modal-body">
                  <div class="row">
                  <form>
                  	<input type="text" class="form-control" id="summary_feedback" placeholder="Summary of your thoughts and experience for this user" />
                    
                    <div class="form-group" style="margin-top:15px">
                        <label class="col-md-7 control-label" style="margin-top:10px;text-align:right">How accurate was the item description?</label>
                        <div class="col-md-5">
                            <input class="description-rating">
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:15px">
                        <label class="col-md-7 control-label" style="margin-top:10px;text-align:right">How satisfied were you with the users communication?</label>
                        <div class="col-md-5">
                            <input class="communication-rating">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-7 control-label" style="margin-top:10px;text-align:right">How quickly did the user dispatch the item(s)?</label>
                        <div class="col-md-5">
                            <input class="shipping-rating">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-7 control-label" style="margin-top:10px;text-align:right">Would you recommend this company to other users?</label>
                        <div class="col-md-5">
                            <input class="company-rating">
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
            
    <!-- Feedback Stars -->
    <link rel="stylesheet" href="public/main/template/gsm/css/star-rating.min.css" rel="stylesheet">
    <script type="text/javascript" src="public/main/template/gsm/js/star-rating.min.js"></script>
    <script>
    jQuery(document).ready(function () {
        $('.description-rating').rating({'showCaption':true, 'stars':'5', 'min':'0', 'max':'5', 'step':'1', 'size':'xs', 'starCaptions': {0:'Very inaccurate', 1:'Very inaccurate', 2:'Inaccurate', 3:'Neither inaccurate nor accurate', 4:'Accurate', 5:'Very accurate'}});
        $('.communication-rating').rating({'showCaption':true, 'stars':'5', 'min':'0', 'max':'5', 'step':'1', 'size':'xs', 'starCaptions': {0:'Very Poor', 1:'Very Poor', 2:'Poor', 3:'Average', 4:'Good', 5:'Excellent'}});
        $('.shipping-rating').rating({'showCaption':true, 'stars':'5', 'min':'0', 'max':'5', 'step':'1', 'size':'xs', 'starCaptions': {0:'Very Slowly', 1:'Very Slowly', 2:'Slowly', 3:'Neither slowly nor quickly', 4:'Quickly', 5:'Very quickly'}});
        $('.company-rating').rating({'showCaption':true, 'stars':'5', 'min':'0', 'max':'5', 'step':'1', 'size':'xs', 'starCaptions': {0:'Very unlikely', 1:'Very unlikely', 2:'Unlikely', 3:'Neither likely or unlikely', 4:'Likely', 5:'Very likely'}});
    });
	</script>
    