<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'type',
        'produit',
        'fournisseur',
        'prix_achat',
        'date',
        'quantite',
        'date_stock'
    ];
    public function getProduit()
    {
        return Produit::where('id',$this->produit)->first();
    }

    public function getProduct()
    {
        return Product::find($this->product);
    }

}
