<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'author_id',
        'status',
        'content',
        'custom_fields',
        'meta_keywords',
        'meta_description',
        'created_at'
    ];

    public function author()
    {
        return $this->hasOne('App\Http\Models\User','id', 'author_id');
    }


}
