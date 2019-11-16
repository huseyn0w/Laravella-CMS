<?php

namespace App\Http\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use Cachable;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'status'
    ];
}
