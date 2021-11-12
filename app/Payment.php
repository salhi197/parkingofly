<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'montant',
        'reservation',
        'type',
        'recu',
        'remarque',
        'date_payment'
    ];
    public function getReservation()
    {
        return Reservation::find($this->reservation);
    }
}
