<?php

namespace App\Http\Models\CPanel;

use Illuminate\Database\Eloquent\Model;

class CPanelMedia extends Model
{
    protected $table = 'media';

    protected $fillable = ['filename'];
}
