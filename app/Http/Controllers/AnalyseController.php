<?php

namespace App\Http\Controllers;
use App\Commune;
use App\Wilaya;
use App\Stock;
use App\Categorie;
use App\Setting;
use App\Header;
use Carbon\Carbon;
use App\Produit;
use App\Organo;
use App\Unite;
use App\Operateur;
use App\Element;
use App\Element2;
use Dompdf\Dompdf;
use Redirect;
use App\Client;
use App\Header2;
use App\Row;
use App\Reference;
use App\Template;
use Hash;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\StoreProduit;
use App\Analyse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class AnalyseController extends Controller
{
    public function destroyList(Request $request)
    {
        $data = explode(',',  $_GET['id']);
        foreach ($data as $key => $c) {
            if (strlen($c)) {
                $analyse =  Analyse::find($c);
                Element::where('analyse',$analyse->id)->delete();
                Header::where('analyse',$analyse->id)->delete();

                $analyse->delete();
            }
        }

        return redirect()->back()->with('success', 'les Analyses ont été supprimés ');           
    }

    public function operateur()
    {
        if(Auth::guard('operateur')->user()){
            $operateur_id = Auth::guard('operateur')->id();
            $analyses = Analyse::all();
            $analyses = Analyse::where('operateur1', $operateur_id)
                    ->orWhere('operateur1', $operateur_id)
                    ->get();
            // $analyses = Analyse::where(['operateur',$operateur_id])->get();
            $date_fin="";
            $date_debut="";
            return view('analyses.index',compact('analyses','date_debut','date_fin'));    
        }

    }


    public function index()
    {
        $analyses = Analyse::all();
        $date_fin="";

        $date_debut="";
        return view('analyses.index',compact('analyses','date_debut','date_fin'));

    }
    public function filter(Request $request){
        $result = Analyse::query();
        $date_fin="";
        $date_debut="";

        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('date_facture', '>=', $request['date_debut']);
        }
    
        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('date_facture', '<=', $request['date_fin']);
        }
        $analyses = $result->get();
        return view('analyses.index',compact('analyses',
            'state',
            'date_debut',
            'date_fin'
        ));
    }

    public function CreateForSingleProduit($produit_id)
    {
        $produit = Produit::where('id',$produit_id)->first();

        $operateurs = Operateur::all();
        $operateurs1 = Operateur::where('type',"1")->get();
        $operateurs2 = Operateur::where('type',"2")->get();
        $produits = Produit::all();
        $clients = Client::all();
        $references = $produit->getReferences();
        $normes = $produit->getNormes();

        $settings = $produit->getSettings();
        $unites = $produit->getUnites();
        $categories = Categorie::all();
        $aspect_couleurs = Organo::where('type',1)->get();
        $gout_odeurs = Organo::where('type',2)->get();
        $examen_macroscopiques = Organo::where('type',3)->get();

        $rows1 = Row::where(['produit'=>$produit->id,'type'=>'physico'])->get();
        
        $rows2 = Row::where(['produit'=>$produit->id,'type'=>'micro'])->get();

        return view('analyses.produit',compact('operateurs1',
        'rows1','rows2',
        'operateurs2',
        'produits',
        'produit',
        'categories',
        'clients',
        'settings',
        'references',
        'unites',
        'operateurs',
        'aspect_couleurs',
        'gout_odeurs',
        'produit_id',
        'normes',
        'examen_macroscopiques'));
    }


    public function create()
    {
        $operateurs1 = Operateur::where('type',"1")->get();
        $operateurs2 = Operateur::where('type',"2")->get();
        $produits = Produit::all();
        $clients = Client::all();
        $unites = Unite::all();
        $references = Reference::all();

        $settings = Setting::all();
        $categories = Categorie::all();
        $aspect_couleurs = Organo::where('type',1)->get();
        $gout_odeurs = Organo::where('type',2)->get();
        $examen_macroscopiques = Organo::where('type',3)->get();

        return view('analyses.create',compact('operateurs1','operateurs2','produits','categories','clients','settings','unites','references','aspect_couleurs','gout_odeurs','examen_macroscopiques'));
    }

    
    public function store(Request $request)
    {
        $inscrit = 0;
        // dd($inscrit);
        if($request['inscrit']=="on"){
            $inscrit = 1;
        }

        $type_analyse_1 = 1;
        $type_analyse_2 = 1;
        if ($request['type_analyse_1'] == null) {
            $type_analyse_1= 0;
        }   
        if($request['type_analyse_2']==null){   
            $type_analyse_2 = 0;
        }
        $validated = $request->validate([
        ]);    

        $count = Analyse::all()->count()+1;
        $jour1 = date("z")+1;
        $count1 = Analyse::where([
                'type_analyse_1' => 1,
                'inscrit'=>1
            ])->get()->count()+1;
        $code1 = sprintf("%03d", $count1).'R'.sprintf("%03d", $count).'/'.date('Y');
        $count2 = Analyse::where([
                'type_analyse_2' => 1,
                'inscrit'=>1
            ])->get()->count()+1;
        $code2 = sprintf("%03d", $count2).'R'.sprintf("%03d", $count).'/'.date('Y');
        $id= DB::table('analyses')->max('id');
        $analyse = new Analyse();   
        $analyse->type_analyse_1 = $type_analyse_1;
        $analyse->type_analyse_2 = $type_analyse_2;
        
        $analyse->code1 = $code1;
        $analyse->jour = $jour1;
        $analyse->code2 = $code2;
        $analyse->categorie = $request['categorie'];
        $analyse->inscrit = $inscrit;
        $analyse->produit = $request['produit'];
        $analyse->date_impression = $request['date_impression'];
        $analyse->marque = $request['marque'];
        $analyse->quantite = $request['quantite'];
        $analyse->fabrication = $request['fabrication'];
        $analyse->peremption = $request['peremption'];
        $analyse->prelevement = $request['prelevement'];
        $analyse->conformite = $request['conformite'];
        $analyse->conformite1 = $request['conformite1'];
        $analyse->conformite2 = $request['conformite2'];
        $analyse->reception = $request['reception'];
        $analyse->analyse = $request['analyse'];
        $analyse->operateur1 = $request['operateur1'];
        $analyse->operateur2 = $request['operateur2'];
        $analyse->client = $request['client'];
        $analyse->date_fin = $request['date_fin'];
        $analyse->macroscopique = $request['examen_macroscopique'];
        $analyse->lot = $request['lot'];
        $analyse->valeur = $request['valeur'];
        $analyse->contenance = $request['contenance'];
        $analyse->aspect_couleur=$request['aspect_couleur'];
        $analyse->gout_odeur=$request['gout_odeur'];
        $analyse->data_analyse=$request['data_analyse'];
        $analyse->duree=$request['duree'];
        $analyse->heure=$request['heure'];        
        try {
            $analyse->save();
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with('error', $th->getMessage());        
        }
        if($request['d']){
            foreach ($request['d'] as $array) {
                $element = new Element();
                $element->parametre = $array['parametre'];
                $element->unite = $array['unite'] ?? '';
                // $element->resultat = $array['resultat'] ?? '';
                $element->resultat1 = $array['resultat1'] ?? '';
                $element->resultat2 = $array['resultat2'] ?? '';
                $element->resultat3 = $array['resultat3'] ?? '';
                $element->resultat4 = $array['resultat4'] ?? '';
                $element->resultat = $array['resultat'];
                $element->reference = $array['reference'];
                $element->norme = $array['norme'];
                $element->analyse = $analyse->id;   
                try {
                    // DB::table('analyses')
                    //     ->where('id', $id)
                    //     ->update(['validation' => date('Y-m-d')]);
                    $element->save();         
                } catch (\Throwable $th) {
                    return Redirect::back()->withInput()->with('error', $th->getMessage());        
                }        
            }    
        }


        if($request['d2']){
            foreach ($request['d2'] as $array) {
                if($array['resultat']!=null){
                    $element = new Element2();
                    $element->parametre = $array['parametre'];
                    $element->unite = $array['unite'] ?? '';
                    // $element->resultat = $array['resultat'] ?? '';
                    $element->resultat1 = $array['resultat1'] ?? '';
                    $element->resultat2 = $array['resultat2'] ?? '';
                    $element->resultat3 = $array['resultat3'] ?? '';
                    $element->resultat4 = $array['resultat4'] ?? '';
                    $element->resultat = $array['resultat'];
                    $element->norme = $array['norme'];
                    $element->reference = $array['reference'];
                    $element->analyse = $analyse->id;   
                    try {
                        // DB::table('analyses')
                        //     ->where('id', $id)
                        //     ->update(['validation' => date('Y-m-d')]);
                        $element->save();         
                    } catch (\Throwable $th) {
                        return Redirect::back()->withInput()->with('error', $th->getMessage());        
                    }        
                }
            }    

        }

        $header = new Header();
        $header->header1 = $request['header1'];
        $header->header2 = $request['header2'];
        $header->header3 = $request['header3'];
        $header->header4 = $request['header4'];
        $header->header5 = $request['header5'];
        $header->header6 = $request['header6'];
        $header->header7 = $request['header7'];
        $header->header7 = $request['header7'];
        $header->header8 = $request['header8'];
        $header->header9 = $request['header9'];
        $header->save();
        Analyse::where('id',$analyse->id)->update(['header' => $header->id]);


        $header = new Header2();
        $header->header1 = $request['header_1'];
        $header->header2 = $request['header_2'];
        $header->header3 = $request['header_3'];
        $header->header4 = $request['header_4'];
        $header->header5 = $request['header_5'];
        $header->header6 = $request['header_6'];
        $header->header7 = $request['header_7'];
        $header->header7 = $request['header_7'];
        $header->header8 = $request['header_8'];
        $header->header9 = $request['header_9'];
        
        $header->save();
        Analyse::where('id',$analyse->id)->update(['header2' => $header->id]);
        


        return redirect()->route('analyse.index')->with('success', ' insertion efféctué ');        
    }

    public function print($id_analyse)
    {
        $analyse = Analyse::find($id_analyse);
        $dompdf = new Dompdf();
        $html = Template::Bulletin($analyse);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        $options = $dompdf->getOptions(); 
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);


        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
        return view('analyses.view',compact('produit'));
    }

    public function printMicro($id_analyse)
    {
        $analyse = Analyse::find($id_analyse);
        $dompdf = new Dompdf();
        $html = Template::micro($analyse);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        $options = $dompdf->getOptions(); 
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);
        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
        return view('analyses.view',compact('produit'));
    }

    public function printPhysico($id_analyse)
    {
        $analyse = Analyse::find($id_analyse);
        $dompdf = new Dompdf();
        $html = Template::physico($analyse);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        $options = $dompdf->getOptions(); 
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);
        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
        return view('analyses.view',compact('produit'));
    }




    public function edit($id_analyse)
    {
        $analyse = Analyse::find($id_analyse);

 
        $produit = Produit::find($analyse->produit);
        $rows2 = Row::where(['produit'=>$produit->id,'type'=>'micro'])->get();

        $produit_id = $analyse->produit;
        $operateurs = Operateur::all();
        $operateurs1 = Operateur::where('type',"1")->get();
        $operateurs2 = Operateur::where('type',"2")->get();
        $produits = Produit::all();
        $clients = Client::all();
        $references = $produit->getReferences();
        $normes = $produit->getNormes();
        $settings = $produit->getSettings();
        $unites = $produit->getUnites();
        $categories = Categorie::all();
        $aspect_couleurs = Organo::where('type',1)->get();
        $gout_odeurs = Organo::where('type',2)->get();
        $examen_macroscopiques = Organo::where('type',3)->get();

        $elements= $analyse->getElements();
        $elements2= $analyse->getElements2();

        if($analyse->valider == 0){
            $view = "analyses.edit";
        }else{
            $view = "analyses.edit2";
        }



        $header = Header::find($analyse->header);
        $header2 = Header2::find($analyse->header2);

        return view('analyses.edit',compact('operateurs1',
        'header',
        'header2',
        'rows2',
        'operateurs2',
        'produits',
        'unites',
        'produit',
        'elements',
        'elements2',
        'categories',
        'clients',
        'settings',
        'references',
        'operateurs',
        'aspect_couleurs',
        'gout_odeurs',
        'produit_id',
        'normes',
        'analyse',
        'examen_macroscopiques'));

    }

    public function update(Request $request,$analyse_id)
    {
        $analyse = Analyse::find($analyse_id);  

        $type_analyse_1 = 1;
        $type_analyse_2 = 1;
        if ($request['type_analyse_1'] == null) {
            $type_analyse_1= 0;
        }   
        if($request['type_analyse_2']==null){
            $type_analyse_2 = 0;
        }

        $validated = $request->validate([ 
        ]);    

        $id= DB::table('analyses')->max('id');
        $analyse->type_analyse_1 = $type_analyse_1;
        $analyse->type_analyse_2 = $type_analyse_2;
        $analyse->categorie = $request['categorie'];
        $analyse->produit = $request['produit'];
        $analyse->date_impression = $request['date_impression'];
        $analyse->marque = $request['marque'];
        $analyse->fabrication = $request['fabrication'];
        $analyse->peremption = $request['peremption'];
        $analyse->prelevement = $request['prelevement'];
        $analyse->reception = $request['reception'];
        $analyse->analyse = $request['analyse'];
        $analyse->operateur1 = $request['operateur1'];
        $analyse->operateur2 = $request['operateur2'];
        $analyse->client = $request['client'];
        $analyse->date_fin = $request['date_fin'];
        $analyse->macroscopique = $request['examen_macroscopique'];
        $analyse->lot = $request['lot'];
        $analyse->valeur = $request['valeur'];
        $analyse->contenance = $request['contenance'];
        $analyse->aspect_couleur=$request['aspect_couleur'];
        $analyse->gout_odeur=$request['gout_odeur'];
        $analyse->data_analyse=$request['data_analyse'];
        $analyse->duree=$request['duree'];
        $analyse->heure=$request['heure'];
        $analyse->conformite1 = $request['conformite1'];
        $analyse->conformite2 = $request['conformite2'];

        $analyse->save();
        // foreach ($request['dynamic_form']['dynamic_form'] as $array) {
        //     if($array['resultat']!=null){
                
        //         $element = new Element();
        //         $element->parametre = $array['parametre'];
        //         $element->unite = $array['unite'] ?? '';
        //         // $element->resultat = $array['resultat'] ?? '';
        //         $element->resultat1 = $array['resultat1'] ?? '';
        //         $element->resultat2 = $array['resultat2'] ?? '';
        //         $element->resultat3 = $array['resultat3'] ?? '';
        //         $element->resultat4 = $array['resultat4'] ?? '';
        //         $element->resultat = $array['resultat'];
        //         $element->reference = $array['reference'];
        //         $element->norme = $array['norme'];
        //         $element->analyse = $analyse->id;   
        //         try {
        //             // DB::table('analyses')
        //             //     ->where('id', $id)
        //             //     ->update(['validation' => date('Y-m-d')]);
        //             $element->save();         
        //         } catch (\Throwable $th) {
        //             return Redirect::back()->withInput()->with('error', $th->getMessage());        
        //         }        
        //     }
        // }    


        // foreach ($request['dynamic_form_second']['dynamic_form_second'] as $array) {
        //     if($array['resultat_second']!=null){
        //         $element = new Element2();
                
        //         $element->parametre = $array['parametre_second'];
        //         $element->unite = $array['unite_second'] ?? '';
        //         // $element->resultat = $array['resultat'] ?? '';
        //         $element->resultat1 = $array['resultat_second_1'] ?? '';
        //         $element->resultat2 = $array['resultat_second_2'] ?? '';
        //         $element->resultat3 = $array['resultat_second_3'] ?? '';
        //         $element->resultat4 = $array['resultat_second_4'] ?? '';
        //         $element->resultat = $array['resultat_second'];
        //         $element->reference = $array['reference_second'];
        //         $element->analyse = $analyse->id;   
        //         try {
        //             // DB::table('analyses')
        //             //     ->where('id', $id)
        //             //     ->update(['validation' => date('Y-m-d')]);
        //             $element->save();         
        //         } catch (\Throwable $th) {
        //             return Redirect::back()->withInput()->with('error', $th->getMessage());        
        //         }        
        //     }
        // }

        if($request['d']){
            foreach ($request['d'] as $array) {
                $element = Element::find($array['id']);
                if (!$element) {
                    $element = new Element;
                }

                $element->parametre = $array['parametre'];
                $element->unite = $array['unite'] ?? '';
                // $element->resultat = $array['resultat'] ?? '';
                $element->resultat1 = $array['resultat1'] ?? '';
                $element->resultat2 = $array['resultat2'] ?? '';
                $element->resultat3 = $array['resultat3'] ?? '';
                $element->resultat4 = $array['resultat4'] ?? '';
                $element->resultat = $array['resultat'] ?? '';
                $element->reference = $array['reference'] ?? '';
                $element->norme = $array['norme'] ?? '';
                $element->analyse = $analyse->id;   
                $element->save();
            }    
        }
        if($request['d2']){
            foreach ($request['d2'] as $array) {
                $element = Element2::find($array['id']);

                if (is_null($element)) {
                    $element = new Element2();
                }
                
                $element->parametre = $array['parametre'];
                $element->unite = $array['unite'] ?? '';
                // $element->resultat = $array['resultat'] ?? '';
                $element->resultat1 = $array['resultat1'] ?? '';

                $element->resultat2 = $array['resultat2'] ?? '';

                $element->resultat3 = $array['resultat3'] ?? '';
                $element->resultat4 = $array['resultat4'] ?? '';
                $element->resultat = $array['resultat'] ?? '';
                $element->reference = $array['reference'] ?? '';
                $element->norme = $array['norme'] ?? '';
                $element->analyse = $analyse->id;   

                $element->save();

            }    
        }

        //update header both of them
        $header = Header::find($request['id_header']);
        if(!$header){
            $header = new Header();
        }
        $header->header1 = $request['header1'];
        $header->header2 = $request['header2'];
        $header->header3 = $request['header3'];
        $header->header4 = $request['header4'];
        $header->header5 = $request['header5'];
        $header->header6 = $request['header6'];
        $header->header7 = $request['header7'];
        $header->header7 = $request['header7'];
        $header->header8 = $request['header8'];
        $header->header9 = $request['header9'] ?? '';
        $header->save();
        Analyse::where('id',$analyse->id)->update(['header' => $header->id]);
        $header = Header2::find($request['id_header2']);
        if(!$header){
            $header = new Header2();
        }

        $header->header1 = $request['header_1'];

        $header->header2 = $request['header_2'];
        $header->header3 = $request['header_3'];

        $header->header4 = $request['header_4'];
        $header->header5 = $request['header_5'];
        $header->header6 = $request['header_6'];
        $header->header7 = $request['header_7'];
        $header->header7 = $request['header_7'];
        $header->header8 = $request['header_8'];
        $header->header9 = $request['header_9'];
        try {
            $header->save();
            Analyse::where('id',$analyse->id)->update(['header2' => $header->id]);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()->route('analyse.index')->with('success', $th->getMessage());        
        }



        return redirect()->route('analyse.index')->with('success', ' insertion efféctué ');        
    }

    public function destroy($id_analyse)
    {
        $analyse = Analyse::find($id_analyse);
        Element::where('analyse',$analyse->id)->delete();
        $analyse->delete();
        return redirect()->route('analyse.index')->with('success', 'supprission terminé');        
    }


    public function valider($id_analyse)
    {
        $analyse = Analyse::find($id_analyse);
        $analyse->valider = 1;
        $analyse->validation = Carbon::now();
        $analyse->save();
        return redirect()->route('analyse.index')->with('success', 'Validation terminé');        
    }



}
