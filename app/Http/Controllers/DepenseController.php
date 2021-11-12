<?php

namespace App\Http\Controllers;

use App\Camion;
use App\Attachement;
use App\Depense;

use App\Facture;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class DechargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depenses=Depense::all();
        $_designations  = Depense::all()->pluck('designation');
        return view('depenses.index',compact('depenses','_designations'));//,'filter','type','fournisseurs'));//,compact('attachements'));
    }

    public function filter(Request $request)
    {
        $result = Depense::query();
        $date_fin="";
        $date_debut="";
        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
        }
    
        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
        }

        if (!empty($request['_designation'])) {
            $result = $result->where('designation', '=', $request['_designation']);
        }
        $_designations  = Depense::all()->pluck('designation');

        $depenses = $result->get();
        return view('depenses.index',compact('depenses',
            'date_debut',
            'date_fin',
            '_designations'
        ));        
    }
    public function store(Request $request)
    {

        $decharge  = new Decharge();
        $decharge->montant = $request['montant']; 
        $decharge->designation = $request['designation'];
        $decharge->remarque = $request['remarque'];
        $decharge->date_decharge = $request['date_decharge'];
                 $decharge->save();
        return redirect()->route('decharge.index')->with('success', 'Décharge Inséré  !  ');
    }




     /**
     * Display the specified resource.
     *
     * @param  \App\Camion  $camion
     * @return \Illuminate\Http\Response
     */
    public function reload()
    {
        $sql = "delete from camions where 1=1" ;
        DB::select(DB::raw($sql));
        $sql = "insert into camions (matricule,nom_contacte,telephone) select DISTINCT(a.matricule_camion) as matricule ,a.nom_contacte,a.tel_contacte as telephone from clients a " ;
        $camions=DB::select(DB::raw($sql));
        
        return redirect()
            ->route('camion.index')
            ->with([
                'success' => 'les camion sont actualisés ! '
            ]);
    }

    public function facture($camion)
    {
        $factures = Facture::where(['camion'=>$camion,'type'=>'camion'])->get();
        $camion=Camion::where('matricule',$camion)->get();//DB::select(DB::raw($sql));
        return view('factures.camion',compact('factures','camion'));

        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Camion  $camion
     * @return \Illuminate\Http\Response
     */
    public function edit($camion)
    {
        $camion = Camion::find($camion);
        return view('camions.edit',compact('camion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Camion  $camion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Camion $camion)
    {
            
        $camion = Camion::findOrfail($request['id']);
        $camion->matricule = $request['matricule']; 
        $camion->telephone = $request['telephone']; 
        $camion->adress = $request['adress']; 
        $camion->ville = $request['ville']; 
        $camion->debut = Carbon::parse($request['debut'])->format('Y-m-d');         
        if($request->file('fichier')){
            $fichier = $request->file('fichier')->store(
                'camions/fichiers',
                'public'
            );
        $camion->fichier = $fichier;
        }
        $camion->save();
        
        return redirect()
            ->route('camion.index')
            ->with([
                'success' => 'camion ajouté avec succés  '
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Camion  $camion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_decharge)
    {
        $decharge = Depense::find($id_decharge);
        $decharge->delete();
        return redirect()
            ->route('decharge.index')
            ->with([
                'success' => 'décharge supprimé !   '
            ]);
    }
}
