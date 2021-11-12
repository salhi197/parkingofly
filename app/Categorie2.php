<?php

namespace App;
use App\Wilaya;
use App\User;
use App\Sub;
use App\Commune;
use Illuminate\Database\Eloquent\Model;

class Categorie2 extends Model
{
    protected $notFoundMessage = 'la page est introuvable .';
    protected $table = "categories2";
    protected $fillable = [
        'label',
        'icon',
        'image',
        'conformite1',
        'conformite2',

        
    ];

    public function getSubs()
    {
        $subs = Sub::where('categorie',$this->label)->get();
        return $subs;
    }
}
