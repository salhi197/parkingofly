<?php

namespace App\Http\Controllers;

use App\Fournisseur;
use App\Commune;
use App\Categorie2;
use App\Wilaya;
use App\Sub;
use Response;
use Illuminate\Http\Request;

class Categorie2Controller extends Controller
{
 
    public function index()
    {
        $categories = Categorie2::all();
        return view('categories2.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $categorie = new Categorie2([
            'label' => $request['categorie'],
            'conformite1'=>$request['conformite1'],
            'conformite2'=>$request['conformite2']
        ]);

        $categorie->save();    
        return redirect()->route('categorie2.index')->with('success', 'inserted successfuly ! ');
    }
    public function destroy($categorie)
    {
        $categorie = Categorie2::find($categorie);
        $categorie->delete();
        return redirect()->route('categorie2.index')
            ->with('success', 'supprimé avec succé !');
    }

     public function SousstoreAjax(Request $request)
     {
        if($request->ajax()){
            $array = $request['data'];        
            $data=  array();
            parse_str($array, $data);        
            $categorie = new Categorie2([
                'label' => $data['label'],
                'categorie'=>$data['categorie']
            ]);
            $categorie->save();    
            $response = array(
                'categorie' => $data,
                'msg' => 'catégorie ajouté',
            );        
            return Response::json($response);  
        }
    }
    public function update(Request $request,$categorie_id)
    {
        $categorie = Categorie2::find($categorie_id);
        $categorie->label = $request['categorie'];
        $categorie->conformite1 = $request['conformite1'];
        $categorie->conformite2 = $request['conformite2'];
        $categorie->save();    
        return redirect()->route('categorie2.index')->with('success', 'inserted successfuly ! ');
   }
}
