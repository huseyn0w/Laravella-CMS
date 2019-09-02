<?php

namespace App\Http\Models\CPanel;

use Illuminate\Database\Eloquent\Model;

class CPanelGeneralSettings extends Model
{
    protected $table = 'general_settings';

    public $timestamps = false;

    protected $fillable = [
        'website_name',
        'tagline',
        'contact_email',
        'membership',
        'active_template_name'
    ];
}
