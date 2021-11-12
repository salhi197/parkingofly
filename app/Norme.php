<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Norme extends Model
{
    protected $table = "normes";
    protected $fillable = [
        'valeur',
        'norme'
        ,'type'
    ];
}
