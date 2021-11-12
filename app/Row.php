<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    protected $fillable = [
        'setting',
        'reference',
        'unite',
        'type',
        'norme',
    ];

    public function getFacture()
    {
        return Facture::where('id',$this->facture)->first();
    }
}
