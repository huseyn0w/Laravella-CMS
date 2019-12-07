<?php
/**
 * Laravella CMS
 * File: translation.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 07.12.2019
 */
?>

@if(isset($translation_links) && is_array($translation_links) && !empty($translation_links))

<div class="col-md-12">
    <div class="form-group">
        <label>@lang('cpanel/general.add_translation')</label>
        <p>
            @foreach($translation_links as $title => $link)
                <a href="{{env('APP_URL').$link}}" target="_blank">{{$title}}</a>
            @endforeach
        </p>
    </div>
</div>

@endif