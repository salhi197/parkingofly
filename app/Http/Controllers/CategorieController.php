<?php

namespace App\Http\Controllers;

use App\Fournisseur;
use App\Commune;
use App\Categorie;
use App\Wilaya;
use App\Sub;
use Response;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
 
    public function index()
    {
        $categories = Categorie::all();
        return view('categories.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $categorie = new Categorie([
            'label' => $request['categorie'],
            'conformite1'=>$request['conformite1'],
            'conformite2'=>$request['conformite2']
        ]);

        $categorie->save();    
        return redirect()->route('categorie.index')->with('success', 'inserted successfuly ! ');
    }
    public function destroy($categorie)
    {
        $categorie = Categorie::find($categorie);
        $categorie->delete();
        return redirect()->route('categorie.index')
            ->with('success', 'supprimé avec succé !');
    }
    /**
     * 
     */

     public function SousstoreAjax(Request $request)
     {
        if($request->ajax()){
            $array = $request['data'];        
            $data=  array();
            parse_str($array, $data);        
            $categorie = new Categorie([
                'label' => $data['label'],
                'categorie'=>$data['categorie']
            ]);
            $categorie->save();    
            $response = array(
                'categorie' => $data,
                'msg' => 'catégorie ajouté',
            );        
            return Response::json($response);  // <<<<<<<<< see this line    
        }
    }
    public function update(Request $request,$categorie_id)
    {
        $categorie = Categorie::find($categorie_id);
        $categorie->label = $request['categorie'];
        $categorie->conformite1 = $request['conformite1'];
        $categorie->conformite2 = $request['conformite2'];
        $categorie->save();    
        return redirect()->route('categorie.index')->with('success', 'inserted successfuly ! ');
   }
}
