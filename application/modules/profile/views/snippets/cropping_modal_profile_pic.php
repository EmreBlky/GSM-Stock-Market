<div class="modal fade" id="avatar-modal" aria-hidden="true"
     aria-labelledby="avatar-modal-label"
     role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <?php $attributes = array('class' => 'avatar-form');
            echo form_open_multipart('profile/profileImage', $attributes); ?>
            <div class="modal-header">
                <button class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
            </div>
            <div class="modal-body">
                <div class="avatar-body">

                    <!-- Upload image and data -->
                    <div class="avatar-upload">
                        <input class="avatar-src" name="avatar_src" type="hidden">
                        <input class="avatar-data" name="avatar_data" type="hidden">
                        <!-- <label for="avatarInput">Local upload</label> -->
                        <input class="avatar-input" id="avatarInput" name="avatar_file"
                               style="display:none;" type="file" accept="image/*">
                    </div>

                    <!-- Crop and preview -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="avatar-wrapper" style="width: 400px; margin: auto"></div>
                        </div>
                        <div class="col-md-3" style="display: none">
                            <div class="avatar-preview preview-lg"></div>
                            <div class="avatar-preview preview-md"></div>
                            <div class="avatar-preview preview-sm"></div>
                        </div>
                    </div>

                    <div class="row avatar-btns">
                        <div class="col-md-9">
                            <div class="btn-group" style="display: none">
                                <button class="btn btn-primary" data-method="rotate"
                                        data-option="-90" type="button"
                                        title="Rotate -90 degrees">
                                    Rotate Left
                                </button>
                                <button class="btn btn-primary" data-method="rotate"
                                        data-option="-15" type="button">-15deg
                                </button>
                                <button class="btn btn-primary" data-method="rotate"
                                        data-option="-30" type="button">-30deg
                                </button>
                                <button class="btn btn-primary" data-method="rotate"
                                        data-option="-45" type="button">-45deg
                                </button>
                            </div>
                            <div class="btn-group" style="display: none">
                                <button class="btn btn-primary" data-method="rotate"
                                        data-option="90" type="button"
                                        title="Rotate 90 degrees">
                                    Rotate Right
                                </button>
                                <button class="btn btn-primary" data-method="rotate"
                                        data-option="15" type="button">15deg
                                </button>
                                <button class="btn btn-primary" data-method="rotate"
                                        data-option="30" type="button">30deg
                                </button>
                                <button class="btn btn-primary" data-method="rotate"
                                        data-option="45" type="button">45deg
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary btn-block avatar-save"
                                    type="submit">Done
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if(isset($support_edit)){
                ?>
                <input type="hidden" name="support_pic_edit" value="<?php echo $mid; ?>"/>
            <?php
            }
            ?>
            <?php echo form_close() ?>
            <!-- Form Div -->
        </div>
    </div>
</div>

<script>
    $(function () {
        $("#companyImgForm").submit(function () {
            $.post("profile/companyImage",$(this).serialize(), function () {
                location.reload();
            });
            return false;
        });
    });
</script>