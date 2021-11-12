<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        "nom",
        "prenom",
        "email",
        "telephone",
        "adress",
        "matricule",
        "hotel",
        "place",
        "etat"
    ];
    public function montant()
    {
        $debut = Carbon::parse($this->debut);
        $fin = Carbon::parse($this->fin);
        $diff = $debut->diffInDays($fin);
        $tarif = $this->tarif ?? 0;
        $total = $tarif*$diff;
        return $tarif;
    }
}
