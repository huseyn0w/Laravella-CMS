<?php

namespace App\Http\Models\CPanel;

use Illuminate\Database\Eloquent\Model;

class CPanelGeneralSettings extends Model
{
    protected $table = 'general_settings';

    protected $primaryKey = null;

    public $incrementing = false;


    public $timestamps = false;

    protected $fillable = [
        'website_name',
        'tagline',
        'contact_email',
        'posts_per_page',
        'membership',
        'active_template_name'
    ];
}
