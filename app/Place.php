<?php

namespace App;
use App\Wilaya;
use App\User;
use App\Sub;
use App\Commune;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'hotel',
        'numero',
        'description',
        'disponible'        
    ];

    public function hotel()
    {
        $hotel = Admin::find($this->hotel);
        return $hotel;
    }
}
