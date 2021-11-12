<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'determination',
        'prix',
        'duree',
        'type',
        'aspect',
        'valeur',
        'norme',
        'documentation'
    ];
}
