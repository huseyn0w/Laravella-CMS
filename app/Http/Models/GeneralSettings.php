<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
    protected $fillable = ['website_name','tagline', 'email', 'membership', 'active_template_name'];
}
