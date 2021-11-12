<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        "categorie",
        "type",
        "designation",
        "settings",
        "aspect_couleurs",
        "gout_odeurs",
        "examen_macroscopiques",
        "_references",
        'conformite',
        "unites"
    ];

    public function getCategorie()
    {
        return Categorie::where('id',$this->categorie)->first();
    }

    public function hasSetting($param)
    {   
        $has = false;
        $settings = json_decode($this->settings);
        foreach($settings as $setting){
            $s = json_decode(json_decode($setting));
            if($s->id == $param){
                $has = true;
            }
        }
        return $has;
    }

    public function hasExamenMacroscopique($param)
    {
        $has = false;
        $examen_macroscopiques = json_decode($this->examen_macroscopiques);
        foreach($examen_macroscopiques as $examen_macroscopique){
            $s = json_decode(json_decode($examen_macroscopique));
            if($s->id == $param){
                $has = true;
            }
        }
        return $has;
    }


    public function hasGoutOdeur($param)
    {
        $has = false;
        $gout_odeurs = json_decode($this->gout_odeurs);
        foreach($gout_odeurs as $gout_odeur){
            $s = json_decode(json_decode($gout_odeur));
            if($s->id == $param){
                $has = true;
            }
        }
        return $has;
    }


    public function hasAspectCouleur($param)
    {
        $has = false;
        $aspect_couleurs = json_decode($this->aspect_couleurs);
        foreach($aspect_couleurs as $aspect_couleur){
            $s = json_decode(json_decode($aspect_couleur));
            if($s->id == $param){
                $has = true;
            }
        }
        return $has;
    }
    public function hasReference($param)
    {   
        $has = false;
        $_references = json_decode($this->_references);
        foreach($_references as $_reference){
            $s = json_decode(json_decode($_reference));
            if($s->id == $param){
                $has = true;
            }
        }
        return $has;
    }


    public function hasUnite($param)
    {   
        $has = false;
        $unites = json_decode($this->unites);
        foreach($unites as $unite){
            $s = json_decode(json_decode($unite));
            if($s->id == $param){
                $has = true;
            }
        }
        return $has;
    }

    public function getReferences()
    {
        return Row::where('produit',$this->id)->get()->pluck('reference');    
    } 
    public function getNormes()
    {
        return Row::where('produit',$this->id)->get()->pluck('norme');    
    } 
    public function getUnites()
    {
        return Row::where('produit',$this->id)->get()->pluck('unite');    
    } 
    public function getSettings()
    {
        return Row::where('produit',$this->id)->get()->pluck('setting');    
    } 

}
