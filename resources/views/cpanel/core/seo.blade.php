<?php
/**
 * Laravella CMS
 * File: seo.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 25.10.2019
 */
?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <h4>@lang('cpanel/seo.seo_headline')</h4>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="meta_keywords">@lang('cpanel/seo.meta_keywords_headline')</label>
            <input type="text" id="meta_keywords" required class="form-control" name="meta_keywords" value="{{ old('meta_keywords', isset($entity) ? $entity->meta_keywords : null) }}" >
            <div class="field-desc">
                <p>@lang('cpanel/seo.meta_keywords_text')</p>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="meta_description">@lang('cpanel/seo.meta_description_headline')</label>
            <input type="text" id="meta_description" required class="form-control" name="meta_description" value="{{ old('meta_description', isset($entity) ? $entity->meta_description : null) }}">
            <div class="field-desc">
                <p>@lang('cpanel/seo.meta_description_text')</p>
            </div>
        </div>
    </div>
</div>

