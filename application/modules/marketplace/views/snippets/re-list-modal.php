<div class="modal inmodal fade" id="re_list_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Re-activate Listing</h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post" accept-charset="utf-8">
                    <div class="row margin-top12">
                        <label for="duration">Please Select the Duration of the Listing from now: </label>
                    </div>
                    <div class="row margin-top12">
                        <select class="form-control valid" id="duration" name="duration" aria-invalid="false">
                            <option value="1">1 day</option>
                            <option value="3">3 day</option>
                            <option value="5">5 day</option>
                            <option value="7" selected="">7 day</option>
                            <option value="10">10 day</option>
                            <option value="14">14 day</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="send_msg">Re-List</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>