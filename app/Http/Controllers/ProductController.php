<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Wilaya;
use App\Stock;
use App\Categorie;
use Carbon\Carbon;
use App\Produit;
use App\Product;
use App\Categorie2;

use Hash;
use Response;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\StoreProduit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class ProductController extends Controller
{


    public function index()
    {
        $products = Product::all();
        return view('products.index',compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Produit::all();        
        $categories = Categorie2::all();
        return view('products.create',compact('products','categories'));
    }

    
    public function store(Request $request)
    {
        $product = new Product(); 
        $product->name = $request['name'];
        $product->quantite = $request['quantite'];
        $product->fournisseur = $request['fournisseur'];
        $product->prix_achat = $request['prix_achat'];
        $product->date_fabrication = $request['date_fabrication'];
        $product->date_premption = $request['date_premption'];
        $product->seuil = $request['seuil'];
        $product->duree = $request['duree'];
        $product->lot = $request['lot'];          
        $product->categorie = $request['categorie'];          
        $product->type = $request['type'];          
        $product->save();
        return redirect()->route('product.index')->with('success', 'Inséré avec succés ');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produit  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id_client)
    {
        $product = Stock::find($id_client);

        return view('products.view',compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produit  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id_client)
    {
        $products = Produit::all();        
        $product = Stock::find($id_client);
        return view('products.edit',compact('products','stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produit  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$client_id)
    {
        $product = Stock::find($client_id);  
        $validated = $request->validate([
            'produit'=>'required',
            'fournisseur'=>'required',
            'prix'=>'required',
            'quantite'=>'required',
        ]);  
        $product->produit = $request['produit'];
        $product->fournisseur = $request['fournisseur'];
        $product->prix = $request['prix'];
        $product->quantite = $request['quantite'];
//        $product->date_stock = $request['date_stock'];
        $product->save();
        return redirect()->route('product.index')->with('success', ' inséré avec succés ');        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produit  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_client)
    {
        $product = Stock::find($id_client);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'le Produit a été supprimé ');        
    }

    public function stock($id_client)
    {
        $product = Stock::find($id_client);
        $products = Stock::where('produit_id',$product->id)->orderBy('id','desc')->get();
        $products = Stock::all();
        $fournisseurs =Fournisseur::all();
        $communes = Commune::all();
        $wilayas =Wilaya::all();
        return view('products.index',compact('products','products','products','fournisseurs','communes','wilayas'));
    }


    public function printStock($id_client)
    {
        dd('on est entrain de construire cette page ...');
    }


}
