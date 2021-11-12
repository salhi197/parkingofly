<?php

namespace App\Http\Controllers;

use App\Norme;
use App\Wilaya;
use Carbon\Carbon;
use Hash;
use App\Produit;

use App\Row;
use App\Setting;
use App\Categorie;
use App\Reference;
use App\Unite;
use App\Organo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProduitController extends Controller
{

    public function destroyList(Request $request)
    {
        $data = explode(',',  $_GET['id']);
        foreach ($data as $key => $c) {
            if (strlen($c)) {
                $produit =  Produit::find($c);
                $produit->delete();
            }
        }

        return redirect()->back()->with('success', 'les Produit ont été supprimés ');           
    }



    public function index()
    {
        $produits = Produit::all();
        // foreach($produits as $produit){
        //     $settings = json_decode($produit->settings);
        //     foreach($settings as $setting){
        //         $s = json_decode(json_decode($setting));
        //         dump($s->id);
        //     }
        // }
        // dd('sasa');
        return view('produits.index',compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all();

        $settings1 = Setting::all();//('type','=','physico-chimique')->get();
        $references1 =Reference::all();//('type','=','physico-chimique')->get();
        $unites1 = Unite::all();//('type','=','physico-chimique')->get();
        $normes1 = Norme::all();//('type','=','physico-chimique')->get();

        $settings2 = Setting::all();//('type','=','micro-biologique')->get();
        $references2 =Reference::all();//('type','=','micro-biologique')->get();
        $unites2 = Unite::all();//('type','=','micro-biologique')->get();
        $normes2 = Norme::all();//('type','=','micro-biologique')->get();

        $aspect_couleurs = Organo::where('type',1)->get();
        $gout_odeurs = Organo::where('type',2)->get();
        $examen_macroscopiques = Organo::where('type',3)->get();
        return view('produits.create',compact('type','normes','categories',
        'settings1',
        'unites1',
        'normes1',
        'references1',
        'organos1',
        'settings2',
        'unites2',
        'normes2',
        'references2',
        'organos2',
        'aspect_couleurs','gout_odeurs','examen_macroscopiques'));
    }


    public function createType($type)
    {
        $categories = Categorie::all();
        $settings = Setting::where('type','=',$type)->get();
        $references =Reference::where('type','=',$type)->get();
        $unites = Unite::where('type','=',$type)->get();
        $normes = Norme::where('type','=',$type)->get();



        $aspect_couleurs = Organo::where('type',1)->get();
        $gout_odeurs = Organo::where('type',2)->get();
        $examen_macroscopiques = Organo::where('type',3)->get();
        return view('produits.create2',compact('type','normes','categories','settings','unites','references','organos','aspect_couleurs','gout_odeurs','examen_macroscopiques'));
    }




    public function store(Request $request)
    {
        $settings = array();
        $_references = array();
        $unites = array();
        $examen_macroscopiques = array();
        $gout_odeurs = array();
        $aspect_couleurs = array();
        
        $produit = new Produit();   
        $produit->categorie = $request['categorie'];
        $produit->type = $request['type'];
        $produit->designation = $request['designation'];
        $produit->aspect_couleurs=$request['aspect_couleurs'];
        $produit->gout_odeurs=$request['gout_odeurs'];
        $produit->examen_macroscopiques=$request['examen_macroscopiques'];
        $produit->conformite=$request['conformite'];
        $produit->save();
  
        foreach ($request['dynamic_form']['dynamic_form'] as $array) {
            if($array['setting1']!=null or $array['unite1']!=null or $array['norme1']!=null or $array['_reference1']!=null){
                $row = new Row();
                $row->setting = $array['setting1'] ?? "";
                $row->unite = $array['unite1'] ?? '';
                $row->norme = $array['norme1'] ?? '';
                $row->produit = $produit->id;
                $row->reference = $array['_reference1'] ?? "";
                $row->type="physico";
                try {
                    $row->save();         
                } catch (\Throwable $th) {
                    return redirect()->back()->withInput()->with('error', $th->getMessage());        
                }            
            } 
        }

        foreach ($request['dynamic_form_second']['dynamic_form_second'] as $array) {
            if($array['setting2']!=null or $array['unite2']!=null or $array['norme2']!=null or $array['_reference2']!=null){
                $row = new Row();
                $row->setting = $array['setting2'] ?? "";
                $row->unite = $array['unite2'] ?? '';
                $row->norme = $array['norme2'] ?? '';
                $row->produit = $produit->id;
                $row->type="micro";
                $row->reference = $array['_reference2'] ?? "";
                try {
                    $row->save();         
                } catch (\Throwable $th) {
                    return redirect()->back()->withInput()->with('error', $th->getMessage());        
                }            
            } 
        }



        
       
        return redirect()->route('produit.index')->with('success', 'Produit inséré avec succés ');        
    }

    

    public function edit($id_produit)
    {
        $produit = Produit::find($id_produit);
        $type = $produit->type;

        $categories = Categorie::all();

        $settings1 = Setting::all();//('type','=','physico-chimique')->get();
        $references1 =Reference::all();//('type','=','physico-chimique')->get();
        $unites1 = Unite::all();//('type','=','physico-chimique')->get();
        $normes1 = Norme::all();//('type','=','physico-chimique')->get();

        $settings2 = Setting::all();//('type','=','micro-biologique')->get();
        $references2 =Reference::all();//('type','=','micro-biologique')->get();
        $unites2 = Unite::all();//('type','=','micro-biologique')->get();
        $normes2 = Norme::all();//('type','=','micro-biologique')->get();
    
        $aspect_couleurs = Organo::where('type',1)->get();
        $gout_odeurs = Organo::where('type',2)->get();
        $examen_macroscopiques = Organo::where('type',3)->get();

        $rows1 = Row::where(['produit'=>$produit->id,'type'=>'physico'])->get();
        $rows2 = Row::where(['produit'=>$produit->id,'type'=>'micro'])->get();
        return view('produits.edit',compact('rows1','rows2','produit','type',        
        'settings1',
        'unites1',
        'normes1',
        'references1',
        'organos1',
        'settings2',
        'unites2',
        'normes2',
        'references2',
        'organos2',
        'categories','organos','aspect_couleurs','gout_odeurs','examen_macroscopiques'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$produit_id)
    {
        $produit = Produit::find($produit_id);  
        
        $settings = array();
        $_references = array();
        $unites = array();
        $examen_macroscopiques = array();
        $gout_odeurs = array();
        $aspect_couleurs = array();

        $produit->categorie = $request['categorie'];
        $produit->type = $request['type'];
        $produit->conformite=$request['conformite'];

        $produit->designation = $request['designation'];
        // $produit->settings = json_encode($settings);
        // $produit->_references= json_encode($_references);
        // $produit->unites= json_encode($unites);
        $produit->aspect_couleurs=$request['aspect_couleurs'];
        $produit->gout_odeurs=$request['gout_odeurs'];
        $produit->examen_macroscopiques=$request['examen_macroscopiques'];
        $produit->save();

        foreach ($request['dynamic_form']['dynamic_form'] as $array) {
            if($array['setting1']!=null or $array['unite1']!=null or $array['norme1']!=null or $array['_reference1']!=null){
                $row = new Row();
                $row->setting = $array['setting1'] ?? "";
                $row->unite = $array['unite1'] ?? '';
                $row->norme = $array['norme1'] ?? '';
                $row->produit = $produit->id;
                $row->reference = $array['_reference1'] ?? "";
                try {
                    $row->save();         
                } catch (\Throwable $th) {
                    return redirect()->back()->withInput()->with('error', $th->getMessage());        
                }            
            }

        }

        foreach ($request['dynamic_form_second']['dynamic_form_second'] as $array) {
            if($array['setting2']!=null or $array['unite2']!=null or $array['norme2']!=null or $array['_reference2']!=null){
                $row = new Row();
                $row->setting = $array['setting2'] ?? "";
                $row->unite = $array['unite2'] ?? '';
                $row->norme = $array['norme2'] ?? '';
                $row->produit = $produit->id;
                $row->reference = $array['_reference2'] ?? "";
                try {
                    $row->save();         
                } catch (\Throwable $th) {
                    return redirect()->back()->withInput()->with('error', $th->getMessage());        
                }            
            }

        }

        if($request['d']){
            foreach ($request['d'] as $array) {
                $row = Row::find($array['id']);
                $row->setting = $array['setting'];
                $row->type="physico";
                $row->unite = $array['unite'] ?? '';
                $row->norme = $array['norme'] ?? '';
                $row->produit = $produit->id;
                $row->reference = $array['_reference'];
                $row->save();         
            }    
        }

        if($request['d2']){
            foreach ($request['d2'] as $array2) {
                $row = Row::find($array2['id']);
                $row->type="micro";
                $row->setting = $array2['setting'];
                $row->unite = $array2['unite'] ?? '';
                $row->norme = $array2['norme'] ?? '';
                $row->produit = $produit->id;
                $row->reference = $array2['_reference'];
                $row->save();         
            }    
        }
       
        return redirect()->route('produit.index')->with('success', 'Produit Modifié avec succés ');        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_produit)
    {
        $produit = Produit::find($id_produit);
        $produit->delete();
        return redirect()->route('produit.index')->with('success', 'le Produit a été supprimé ');        
    }


}
