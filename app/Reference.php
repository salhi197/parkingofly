<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = "réferences";
    protected $fillable = [
        'type',
        'methode',
        'setting',
        'produit',
        'determination',
        'type',
        'norme_m',
        'norme_mm',
        'methode'
        
    ];

    public function getProduit()
    {
        return Produit::where('id',$this->produit)->first();
    }
}
