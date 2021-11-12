<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Produit;
use App\Setting;

use Carbon\Carbon;
use Hash;
use App\Norme;
use App\Categorie;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class NormeController extends Controller
{


    public function index()
    {
        $normes = Norme::all();
        return view('normes.index',compact('normes'));
    }

    /**
     * Show the form for creatingNorme new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produits = Produit::all();
        $settings = Setting::all();
        
        return view('normes.create',compact('settings','produits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = unserialize($result['data']);
        // return response()->json(['success'=>$request['value']]);
        if($request->ajax()){
            $norme = new Norme();   
            $norme->valeur = $request['value'];
            // $valeur = $request['value'];
            try {
                $norme->save();
            } catch (\Throwable $th) {
                return response()->json(['success'=>0]);
            }
            return response()->json(['success'=>1]);
        }else{
            $norme = new Norme();   

            $norme->type = $request['type'];
            $norme->valeur = $request['valeur'];
            $norme->save();
            return redirect()->back()->with('success', 'Inséré avec succés ');            
        }

    }

    public function show($id_norme)
    {
        $norme = Norme::find($id_norme);
        return view('normes.view',compact('norme'));
    }

    public function edit($id_norme)
    {
        $produits = Produit::all();
        $settings = Setting::all();
        $norme = Norme::find($id_norme);
        return view('normes.edit',compact('norme','settings','produits'));
    }

    public function update(Request $request,$norme_id)
    {
        $norme = Norme::find($norme_id);  
        $norme->type = $request['type'];
        $norme->methode = $request['methode'];
        $norme->setting = $request['setting'];
        $norme->produit = $request['produit'];
        $norme->norme_m = $request['norme_m'];
        $norme->determination = $request['determination'];
        $norme->norme_mm = $request['norme_mm'];
        $norme->methode = $request['methode'];        
        $norme->save();

        
        return redirect()->route('norme.index')->with('success', 'reservation inséré avec succés ');   
    }


    public function destroy($id_norme)
    {
        $norme = Norme::find($id_norme);
        $norme->delete();
        return redirect()->route('norme.index')->with('success', 'le Norme a été supprimé ');        
    }


}
