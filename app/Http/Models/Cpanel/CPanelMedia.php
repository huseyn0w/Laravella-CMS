<?php

namespace App\Http\Models\Cpanel;

use Illuminate\Database\Eloquent\Model;

class CPanelMedia extends Model
{
    protected $table = 'media';

    protected $fillable = ['filename'];
}
