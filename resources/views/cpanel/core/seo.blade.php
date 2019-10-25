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
            <h4>SEO fields </h4>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="meta_keywords">Meta keywords</label>
            <input type="text" id="meta_keywords" required class="form-control" name="meta_keywords" value="{{ old('meta_keywords', isset($entity) ? $entity->meta_keywords : null) }}" >
            <div class="field-desc">
                <p>Keywords of the page for search engines. Put ',' after every keyword</p>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="meta_description">Meta description</label>
            <input type="text" id="meta_description" required class="form-control" name="meta_description" value="{{ old('meta_description', isset($entity) ? $entity->meta_description : null) }}">
            <div class="field-desc">
                <p>Description of the page for search engines</p>
            </div>
        </div>
    </div>
</div>

