<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class CategoryTranslation extends Model
{
    use Cachable;

    public $timestamps = false;
    protected $fillable = ['title', 'slug', 'category_id', 'locale', 'parent_category_id', 'autor_id', 'description', 'meta_description', 'meta_keywords'];
}
