<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Wilaya;
use App\Product;
use App\Stock;
use App\Commande;

use DB;
use Auth;
use App\Http\Requests\StoreProduct;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $stocks = Stock::all();//DB::table('stocks')->orderBy('id', 'DESC')->get();
        return view('stocks.index',compact('stocks','products'));
    }

    public function detail($id_stock)
    {
        $stock =Stock::find($id_stock);
        $product = Product::find($stock->product_id);

        $commande = Commande::find(1);
        return view('stocks.detail',compact('stock','commande','product'));

    }


    public function print($id_stock)
    {
        $stock =Stock::find($id_stock);
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions(); 
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);
        $html = Commande::templateStock('test');
        $dompdf->loadHtml($html);
        $dompdf->render();
        $current = date('Y-m-d');
        $file = "facture_".$current;
        $dompdf->stream("$file", array('Attachment'=>1));

    }
    public function entrer(Request $request)
    {

        foreach ($request['dynamic_form']['dynamic_form'] as $array) {
            $product_json = json_decode($array['product'], true);
            $product  = Product::find($product_json['id']);
            $qteOld = $product->quantite;
            $qteNew = $qteOld + $array['quantite'];  
            $product->quantite = $qteNew;
            $product->save();
            $stock = new  Stock();
            $stock->product = $array['product'];
            $stock->product_id = $product->id;
            $stock->quantite = $array['quantite'];
            $stock->date = $array['date'];
            
            $stock->operation = 'entré';

            $stock->save();


        }    
        return redirect()->route('stock.index')->with('success', 'insertion effectué !  ');     

    }

    public function sortie(Request $request)
    {

        
        foreach ($request['dynamic_form_sortie']['dynamic_form_sortie'] as $array) {
            $product_json = json_decode($array['product'], true);
            $product  = Product::find($product_json['id']);
            $qteOld = $product->quantite;
            $qteNew = $qteOld - $array['quantite'];  
            $product->quantite = $qteNew;
            $product->save();
            $stock = new  Stock();
            $stock->product = $array['product'];
            $stock->product_id = $product->id;
            $stock->quantite = $array['quantite'];
            $stock->date = $array['date2'];
            $stock->operation = 'sortie';

            $stock->save();
        }    
        return redirect()->route('stock.index')->with('success', 'insertion effectué !  ');     
    }

    public function destroy($id_stock)
    {
        $stock = Stock::find($id_stock);
        $stock->delete();
        return redirect()->route('stock.index')->with('success', 'le Product a été supprimé ');        
    }


}
