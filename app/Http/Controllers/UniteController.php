<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Produit;
use App\Setting;

use Carbon\Carbon;
use Hash;
use App\Unite;
use App\Categorie;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UniteController extends Controller
{


    public function index()
    {
        $unites = Unite::all();
        return view('unites.index',compact('unites'));
    }

    /**
     * Show the form for creatingUnite new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produits = Produit::all();
        $settings = Setting::all();
        
        return view('unites.create',compact('settings','produits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unite = new Unite();   
        $unite->nom = $request['nom'];        
        $unite->type = $request['type'];        
        // $unite->symbole = $request['symbole'];        
        $unite->save();
        return redirect()->back()->with('success', 'Inséré avec succés ');        
    }

    public function show($id_unite)

    {
        $unite = Unite::find($id_unite);
        return view('unites.view',compact('unite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unite  $unite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$unite_id)
    {
        $unite = Unite::find($unite_id);  
        $unite->nom = $request['nom'];        
        $unite->symbole = $request['symbole'];        
        $unite->save();

        
        return redirect()->route('unite.index')->with('success', 'reservation inséré avec succés ');   
    }


    public function destroy($id_unite)
    {
        $unite = Unite::find($id_unite);
        $unite->delete();
        return redirect()->route('unite.index')->with('success', 'le Unite a été supprimé ');        
    }


}
