<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class MenuTranslation extends Model
{
    use Cachable;

    public $timestamps = false;
    protected $fillable = ['title', 'menu_id', 'locale', 'slug', 'author_id', 'content'];
}
