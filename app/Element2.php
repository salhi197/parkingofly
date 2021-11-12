<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element2 extends Model
{
    protected $table = "elements2";
    protected $fillable = [
        /**
         * resulata ltype danalyse li 3andou whd 
         * mais res w res 1 .. 4 hadou ta3 2eme type d'analyse
         * mohim
         */
        'parametre',
        'unite',
        'resultat',
        'resultat1',
        'resultat2',
        'resultat3',
        'resultat4',
        'reference',
        'analyse',
        'norme'
    ];
    public static function findOrCreate($id)
    {
        $obj = static::find($id);
        return $obj ?: new static;
    }

    public function getSetting()
    {
        return Setting::find($this->parametre)['determination'] ?? 'vide';        
    } 
    public function getUnite()
    {
        return Unite::find($this->unite)['nom'] ?? 'vide';
    } 

    public function getNomUnite($unite)
    {
        return Unite::find($unite)['nom'] ?? 'vide';
    } 

}
