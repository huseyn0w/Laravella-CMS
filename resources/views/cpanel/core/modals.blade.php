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
                        <label for="custom_text_label">@lang('cpanel/custom-fields.text_label')</label>
                        <input type="text" id="custom_text_label" required="" class="form-control" name="input_label">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_input_name">@lang('cpanel/custom-fields.text_name')</label>
                        <input type="text" id="custom_input_name" required="" class="form-control" name="input_name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-simple" id="add_custom_input_text">@lang('cpanel/custom-fields.add_button_label')</button>
                <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">@lang('cpanel/custom-fields.close_button_label')</button>
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
                        <label for="custom_textarea_label">@lang('cpanel/custom-fields.textarea_label')</label>
                        <input type="text" id="custom_textarea_label" required="" class="form-control" name="input_label">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_textarea_name">@lang('cpanel/custom-fields.text_name')</label>
                        <input type="text" id="custom_textarea_name" required="" class="form-control" name="input_name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-simple" id="add_custom_textarea_input">@lang('cpanel/custom-fields.add_button_label')</button>
                <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">@lang('cpanel/custom-fields.close_button_label')</button>
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
                        <label for="custom_link_key">@lang('cpanel/custom-fields.link_key')</label>
                        <input type="text" id="custom_link_key" required="" class="form-control" name="input_key">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="admin_text_label">@lang('cpanel/custom-fields.link_cpanel_label')</label>
                        <input type="text" id="admin_text_label" required="" class="form-control" name="input_admin_label">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_textarea_label">@lang('cpanel/custom-fields.link_label')</label>
                        <input type="text" id="custom_link_label" required="" class="form-control" name="input_label">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_link_url">@lang('cpanel/custom-fields.link_url')</label>
                        <input type="text" id="custom_link_url" required="" class="form-control" name="input_name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-simple" id="add_custom_link">@lang('cpanel/custom-fields.add_button_label')</button>
                <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">@lang('cpanel/custom-fields.close_button_label')</button>
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
                        <label for="custom_image_label">@lang('cpanel/custom-fields.image_label')</label>
                        <input type="text" id="custom_image_label" required="" class="form-control" name="input_label">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_image_key">@lang('cpanel/custom-fields.image_key')</label>
                        <input type="text" id="custom_image_key" required="" class="form-control" name="input_key">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_input_image">@lang('cpanel/custom-fields.image_key')</label>
                        <span class="input-group-btn">
                              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary choose-image">
                                <i class="fa fa-picture-o"></i> @lang('cpanel/custom-fields.image_preview_label')
                              </a>
                            </span>
                        <input id="thumbnail" class="form-control" type="text" name="filepath">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-simple" id="add_custom_image">@lang('cpanel/custom-fields.add_button_label')</button>
                <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">@lang('cpanel/custom-fields.close_button_label')</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-mini modal-primary" id="custom_category_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_category_label">@lang('cpanel/custom-fields.text_label')</label>
                        <input type="text" id="custom_category_label" required="" class="form-control" name="category_label">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="custom_category_name">@lang('cpanel/custom-fields.text_name')</label>
                        <input type="text" id="custom_category_name" required="" class="form-control" name="category_name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-simple" id="add_custom_category_text">@lang('cpanel/custom-fields.add_button_label')</button>
                <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">@lang('cpanel/custom-fields.close_button_label')</button>
            </div>
        </div>
    </div>
</div>


<script>
    var site_url = "<?php echo env('APP_URL'); ?>/";
</script>