<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organo extends Model
{
    protected $fillable = [
        'type',
        'value'
    ];
}
