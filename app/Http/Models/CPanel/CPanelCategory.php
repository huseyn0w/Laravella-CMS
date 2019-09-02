<?php

namespace App\Http\Models\CPanel;

use Illuminate\Database\Eloquent\Model;

class CPanelCategory extends Model
{
    protected $table = 'categories';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'parent_category',
        'description'
    ];
}
