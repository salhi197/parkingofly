<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analyse extends Model
{
    protected $fillable = [
        'type',
        'valider',
        'type_analyse_1',
        'date_impression',
        'type_analyse_2',
        'jour',
        'inscrit',
        'code1',
        'code2',
        'header2',
        'analyse_fait',
        'heure',
        'header',
        'data_analyse',
        'validation',
        'etat',
        'conformite_physico',
        'conformite_micro',
        'conformite',
        'conformite1',
        'conformite2',
        'date_fin',
        'heure',
        'categorie',
        'produit',
        'marque',
        'fabrication',
        'peremption',
        'prelevement',
        'reception',
        'analyse',
        'operateur1',
        'operateur2',
        'client',
        'lot',
        'valeur',
        'duree',
        'quantite',
        'aspect_couleur',
        'gout_odeur',
        'macroscopique',
        'contenance'        
    ];
    public function getClient()
    {
        return Client::where('id',$this->client)->first();
    }

    public function getCategorie()
    {
        return Categorie::where('id',$this->categorie)->first();
    }

    public function getProduit()
    {
        return Produit::where('id',$this->produit)->first();
    }

    public function getElements()
    {
        return Element::where('analyse',$this->id)->get();
    }

    public function getElements2()
    {
        return Element2::where('analyse',$this->id)->get();
    }

    
    public function getOperateur()
    {
        return Operateur::where('id',$this->operateur)->first();
    }

}
