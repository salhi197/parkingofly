<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'quantite',
        'fournisseur',
        'prix_achat',
        'date_fabrication',
        'type',
        'duree',
        'categorie',
        'date_premption',
        'seuil',
        'lot'
    ];

}
