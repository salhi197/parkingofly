<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Produit;
use App\Setting;

use Carbon\Carbon;
use Hash;
use App\Organo;
use App\Categorie;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OrganoController extends Controller
{


    public function index()
    {
        $organos = Organo::all();
        return view('organos.index',compact('organos'));
    }

    /**
     * Show the form for creatingOrgano new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('organos.create',compact('settings','produits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $organo = new Organo();   
        $organo->type = $request['type'];
        $organo->value = $request['value'];
        $organo->save();
        return redirect()->back()->with('success', 'Inséré avec succés ');        
    }

        public function show($id_organo)

    {
        $organo = Organo::find($id_organo);
        return view('organos.view',compact('organo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organo  $organo
     * @return \Illuminate\Http\Response
     */
    public function edit($id_organo)
    {
        $produits = Produit::all();
        $settings = Setting::all();
        $organo = Organo::find($id_organo);
        return view('organos.edit',compact('organo','settings','produits'));
    }

    public function update(Request $request,$organo_id)
    {
        $organo = Organo::find($organo_id);  
        $organo->type = $request['type'];
        $organo->value = $request['value'];
        $organo->save();
        return redirect()->route('organo.index')->with('success', 'Inséré avec succés ');        
    }


    public function destroy($id_organo)
    {
        $organo = Organo::find($id_organo);
        $organo->delete();
        return redirect()->route('organo.index')->with('success', 'le Organo a été supprimé ');        
    }


}
