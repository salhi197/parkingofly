<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Fournisseur;
use App\Commune;
use App\Categorie;
use Auth;
use App\Wilaya;
use App\Place;
use App\Sub;
use Response;
use Illuminate\Http\Request;

class PlaceController extends Controller
{

    public function index()
    {
        $places = Place::all();
        $hotels = Admin::all();
        
        return view('places.index',compact('places','hotels'));
    }

    public function store(Request $request)
    {
        $id = Auth::guard('admin')->id();
        $place = new Place([
            'hotel'=>$id,
            'label' => 'place',
            'numero'=>$request['numero'],
            'disponible'=>1,
            
        ]);
        $place->save();    
        return redirect()->route('place.index')->with('success', 'inserted successfuly ! ');
    }
    public function destroy($place)
    {
        $place = Place::find($place);
        $place->delete();
        return redirect()->route('place.index')
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
            $place = new Categorie([
                'label' => $data['label'],
                'categorie'=>$data['categorie']
            ]);
            $place->save();    
            $response = array(
                'categorie' => $data,
                'msg' => 'catégorie ajouté',
            );        
            return Response::json($response);  // <<<<<<<<< see this line    
        }
    }
    public function update(Request $request,$place_id)
    {
        $place = Place::find($place_id);
        $place->label =$request['label'];
        $place->numero=$request['numero'];
        $place->save();    
        return redirect()->route('place.index')->with('success', 'inserted successfuly ! ');
   }
}
