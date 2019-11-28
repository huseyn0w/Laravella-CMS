<?php

namespace App\Http\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Menu extends Model implements TranslatableContract
{
//    use Cachable;

    use Translatable;

    public $translatedAttributes = ['title', 'author_id', 'content'];

    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'author_id'
    ];

    public function author()
    {
        return $this->hasOne('App\Http\Models\User','id', 'author_id');
    }
}
