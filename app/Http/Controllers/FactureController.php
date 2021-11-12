<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Item;
use App\Produit;
use App\Operateur;
use Response;
use Dompdf\Dompdf;
use Redirect;
use App\Setting;
use App\Client;
use App\Facture;
use App\Template;
use Hash;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\StoreProduit;
use App\Analyse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class FactureController extends Controller
{


    public function index()
    {
        $factures = Facture::all();
        return view('factures.index',compact('factures'));
    }

    public function calculer(Request $request)
    {
        $total = 0;
        $tva=0;
        foreach ($request['data']['dynamic_form[dynamic_form'] as $array) {
            $sous_total = ($array['prix']*$array['quantite']);
            $total = $sous_total+$total;
        }    
        $tva = $total*0.19;
        $ttc = $total+$tva;
        return Response::json(['total'=>$total,'tva'=>$tva,'ttc'=>$ttc]);
    }

    public function groupShow()
    {
        $clients = Client::all();
        $date_fin="";
        $date_debut="";
        return view('factures.group',compact('clients','date_fin','date_debut'));
    }


    public function create()
    {
        $produits = Produit::all();
        $clients = Client::all();
        $categories = Categorie::all();
        $settings = Setting::all();
        $analyses = Analyse::all();
        $maxValue = Facture::max('id')+1;

        return view('factures.create',compact('produits','analyses','categories','clients','settings','maxValue'));
    }

    public function group(Request $request)
    {

        $produits = Produit::all();
        $clients = Client::all();
        $categories = Categorie::all();
        $settings = Setting::all();
        $analyses = Analyse::all();
        $maxValue = Facture::max('id')+1;

        $result = Analyse::query();
        $date_fin="";
        $date_debut="";
        if (!empty($request['client'])) {
            $client = Client::find($request['client']);
            $result = $result->where('client', '=', $request['client']);
        }

        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
        }
    
        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
        }
        $analyses = $result->get();

        return view('factures.create',compact('produits','analyses','categories','clients','settings','maxValue',
            'date_debut',
            'client',
            'date_fin'
        ));

    }

    
    public function store(Request $request)
    {
        $facture = new Facture(); 
        $facture->client = $request['client'];
        $facture->typo = $request['typo'];
        $facture->date = $request['date'];
        $facture->numero = $request['numero'];
        $facture->total_lettre = $request['total_lettre'];
        $facture->numerobc = $request['numerobc'];
        $facture->convention = $request['convention'];
        $facture->type = $request['type'];
        $facture->total = 0;
        $facture->ttc = 0;        
        try {
            $facture->save();
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with('error', $th->getMessage());        
        }
        $total =0;
        $sous_total = 0;
        if($request['d2']){
            
            foreach ($request['d2'] as $array) {
                $item = new Item();
                $sous_total = ($array['prix']*$array['quantite']);
                $total = $sous_total+$total;
                $item->setting = $array['setting'];
                $item->produit = $array['produit'];
                $item->type = $array['type'];
                $item->quantite = $array['quantite'];
                $item->prix = $array['prix'];
                $item->montant = $array['prix']*$array['quantite'];  
                $item->facture = $facture->id;          
                try {
                    $item->save();
                } catch (\Throwable $th) {
                    return Redirect::back()->withInput()->with('error', $th->getMessage());        
                }        
            }
        } 

        /**
         * update khfife
         */
        if($request->type == 'timbre'){
            DB::table('factures')
            ->where('id',$facture->id)
            ->update(['total' => $total,'ttc'=>$total+5]);            
        }else{
            $tva = $total*0.19;
            $ttc = $total+$tva;    
            DB::table('factures')
            ->where('id',$facture->id)
            ->update(['total' => $total,'ttc'=>$ttc,'reste'=>$ttc]);            
        }
        return redirect()->route('facture.index')->with('success', ' insertion efféctué ');        
    }

    public function print($id_analyse)
    {
        $facture = Facture::find($id_analyse);
        $dompdf = new Dompdf();
        $html = Facture::template($facture);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();        
        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
        return view('factures.view',compact('produit'));
    }

    public function proformat($id_analyse)
    {
        $facture = Facture::find($id_analyse);
        $dompdf = new Dompdf();
        $html = Facture::proformat($facture);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();        
        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
        return view('factures.view',compact('produit'));
    }

    public function edit($id_analyse)
    {
        $facture = Facture::find($id_analyse);  
        $produits = Produit::all();
        $clients = Client::all();
        $categories = Categorie::all();
        $settings = Setting::all();
        $SelectedClient = Client::find($facture->client);
        $items = Item::where('facture',$facture->id)->get();
        return view('factures.edit',compact('items','facture','produits','categories','clients','settings','SelectedClient'));
    }

    public function update(Request $request,$facture_id)
    {
        $facture= Facture::find($facture_id);
        $facture->client = $request['client'];
        $facture->date = $request['date'];
        $facture->numero = $request['numero'];
        $facture->numerobc = $request['numerobc'];
        $facture->convention = $request['convention'];
        $facture->type = $request['type'];
        $facture->total = 0;
        $facture->ttc = 0;
        
        try {
            $facture->save();
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with('error', $th->getMessage());        
        }
        $total =0;
        $sous_total = 0;
        if($request['d']){
            foreach ($request['d'] as $array) {
                $item = Item::find($array['id']);
                $sous_total = ($array['prix']*$array['quantite']);
                $total = $sous_total+$total;
                $item->setting = $array['setting'];
                $item->produit = $array['produit'];
                $item->type = $array['type'];
                $item->quantite = $array['quantite'];
                $item->prix = $array['prix'];
                $item->montant = $array['prix']*$array['quantite'];  
                $item->facture = $facture->id;
                $item->save();
            }    
        }
        
        foreach ($request['dynamic_form']['dynamic_form'] as $array) {
            if($array['produit']!=null){
                $item = new Item();
                $sous_total = ($array['prix']*$array['quantite']);
                $total = $sous_total+$total;
                $item->setting = $array['setting'];
                $item->produit = $array['produit'];
                $item->type = $array['type'];
                $item->quantite = $array['quantite'];
                $item->prix = $array['prix'];
                $item->montant = $array['prix']*$array['quantite'];  
                $item->facture = $facture->id;          
                try {
                    $item->save();
                } catch (\Throwable $th) {
                    return Redirect::back()->withInput()->with('error', $th->getMessage());        
                }
            }    
        }
        return redirect()->route('facture.index')->with('success', ' Modification  efféctué ');        

    }

    public function destroy($id_analyse)
    {
        $facture = Facture::find($id_analyse);
        Item::where('facture',$id_analyse)->delete();
        $facture->delete();
        return redirect()->route('facture.index')->with('success', 'supprission terminé');        
    }




}
