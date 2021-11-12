<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Operateur extends Authenticatable
{
    protected $fillable = [
        "nom",
        "email",
        "password_text",
        "role",
        "type"
    ];
    public function getCategorie()
    {
        return Categorie::where('id',$this->categorie)->first();
    }

}
