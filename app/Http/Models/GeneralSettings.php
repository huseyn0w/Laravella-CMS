<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'website_name',
        'tagline',
        'contact_email',
        'membership',
        'active_template_name'
    ];
}
