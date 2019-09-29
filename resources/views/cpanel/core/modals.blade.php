<?php
/**
 * Laravella CMS
 * File: modals.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 24.09.2019
 */
?>


<div class="modal fade modal-mini modal-primary" id="custom_text_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_text_label">Label</label>
                        <input type="text" id="custom_text_label" required="" class="form-control" name="input_label">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_input_name">Name</label>
                        <input type="text" id="custom_input_name" required="" class="form-control" name="input_name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-simple" id="add_custom_input_text">Add</button>
                <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modal-mini modal-primary" id="custom_textarea_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_textarea_label">Label</label>
                        <input type="text" id="custom_textarea_label" required="" class="form-control" name="input_label">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_textarea_name">Name</label>
                        <input type="text" id="custom_textarea_name" required="" class="form-control" name="input_name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-simple" id="add_custom_textarea_input">Add</button>
                <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modal-mini modal-primary" id="custom_link_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_link_key">Key</label>
                        <input type="text" id="custom_link_key" required="" class="form-control" name="input_key">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="admin_text_label">Cpanel Label</label>
                        <input type="text" id="admin_text_label" required="" class="form-control" name="input_admin_label">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_textarea_label">Label</label>
                        <input type="text" id="custom_link_label" required="" class="form-control" name="input_label">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_link_url">URL</label>
                        <input type="text" id="custom_link_url" required="" class="form-control" name="input_name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-simple" id="add_custom_link">Add</button>
                <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-mini modal-primary" id="custom_image_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_image_label">Label</label>
                        <input type="text" id="custom_image_label" required="" class="form-control" name="input_label">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_image_key">Key</label>
                        <input type="text" id="custom_image_key" required="" class="form-control" name="input_key">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_input_image">Image</label>
                        <span class="input-group-btn">
                              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary choose-image">
                                <i class="fa fa-picture-o"></i> Choose image
                              </a>
                            </span>
                        <input id="thumbnail" class="form-control" type="text" name="filepath">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-simple" id="add_custom_image">Add</button>
                <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script>
    var site_url = "<?php echo env('APP_URL'); ?>";
</script>