<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        "categorie",
        "raison_sociale",
        "nom",
        "adresse",
        "wilaya",
        "telephone",
        "fax",
        "n_registre",
        "nif",
        "status",
        "etat",
        "nis",
        "n_article",
        "email",
        "type",
        'password_text'
        ,'code'
    ];
    public function getCategories()
    {
        $categories = json_decode($this->categorie);
        return $categories;
    }


    public function getWilaya()
    {
        return Wilaya::find($this->wilaya)['name'];
        // $categories = json_decode($this->categorie);
        // return $categories;
    }


    public function create(Request $request)
    {

    } 

}
