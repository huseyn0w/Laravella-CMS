<?php

namespace App\Http\Models\CPanel;

use Illuminate\Database\Eloquent\Model;

class CPanelSiteOptions extends Model
{
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;

    protected $table = 'site_options';

    protected $fillable = [
        'logo_url',
        'copyright',
        'github_url',
        'linkedin_url'
    ];


}
