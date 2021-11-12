<?php

namespace App\Http\Controllers;

use App\Fournisseur;
use App\Commune;
use App\Hotel;
use App\Wilaya;
use App\Admin;
use Hash;
use App\Sub;
use Response;
use Illuminate\Http\Request;

class HotelController extends Controller
{
 
    public function index()
    {
        $hotels = Admin::all();
        $wilayas = Wilaya::all();
        $communes = Commune::all();
        return view('hotels',compact('hotels','communes','wilayas'));
    }

    public function store(Request $request)
    {
        $hotel= new Admin();
        $hotel->name= $request->get('name');
        $hotel->email= $request->get('email');
        $hotel->telephone= $request->get('telephone');
        $hotel->adress= $request->get('adress');
        $hotel->password=Hash::make($request->get('password'));
        $hotel->password_text= $request->get('password');
        $hotel->wilaya_id = $request->get('wilaya_id');
        $hotel->commune_id = $request->get('commune_id');
        $hotel->save();
        return redirect()->route('hotel.index')->with('success', 'Hotel inséré avec succés ');
    }


    public function destroy($categorie)
    {
        $categorie = Admin::find($categorie);
        $categorie->delete();
        return redirect()->route('hotel.index')
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
