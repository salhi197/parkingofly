<?php

namespace App;
use App\Wilaya;
use App\User;
use App\Sub;
use App\Commune;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'nom',
        'phone',
        'email',
        'adress',        
    ];

    public function getSubs()
    {
        $subs = Sub::where('categorie',$this->label)->get();
        return $subs;
    }
}
