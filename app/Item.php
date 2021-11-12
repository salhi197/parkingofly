<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'setting',
        'produit',
        'type',        
        'quantite',
        'prix',
        'facture',
        'montant'
    ];

    public function getFacture()
    {
        return Facture::where('id',$this->facture)->first();
    }
}
