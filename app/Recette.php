<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    protected $fillable = [
        'montant',
        'client',
        'designation',
        'remarque',
        'date_decharge'
    ];
    public function getClient()
    {
        return $this->Client;
    }
}
