<?php

namespace App\Http\Controllers;
use DB;
use App\Analyse;
use App\Hotel;
use App\Template;
use App\Setting;
use App\Admin;

use App\Reservation;
use Storage;
use Dompdf\Dompdf;
Use Alert;

use Illuminate\Http\Request;
use Response;

class HomeController extends Controller
{
    public function setting()
    {
        $setting = Setting::find(1);
        $tarif = $setting['value'];
        return view('settings',compact('tarif'));

    }

    public function updateSetting(Request $request)
    {
        $setting = Setting::find(1);
        $setting->value = $request['tarif'];
        $setting->save();
        return redirect()->route('setting')->with('success', 'Reservation a été Validé ');

    }

    public function qrcode()
    {

        Storage::makeDirectory('/public/qrcodes', 0775, true);
        $date = date_create();
        $timestamp  = date_timestamp_get($date);
        $qrcode = $timestamp;
        $url = 'http://demo.bibanfret.com/storage/app/public/file_'.$qrcode.'.pdf';
        \QrCode::generate($url, storage_path().'/app/public/qrcodes/'.$timestamp.'.svg');
        $url = 'http://demo.bibanfret.com/qrcode/'.$qrcode;
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions(); 
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);
        $html = Template::qrcode();        
        $dompdf->loadHtml($html);
        $customPaper = array(0,0,290,480);
        $dompdf->setPaper($customPaper);
        $dompdf->render();
        // $dompdf->stream("qrcode_".$qrcode, array('Attachment'=>0));       
        $content = $dompdf->output();
        $file = $dompdf->output();
        Storage::put('public/file_'.$qrcode.'.pdf', $file);
        return view('qrcode',compact('qrcode'));
    }

    public function qrcodePDF($qrcode)
    {
        $url = 'http://demo.bibanfret.com/qrcode/'.$qrcode;
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions(); 
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);

        $style='<style> 
        @page { margin: 0px; }
        body { margin: 0px; }
        
                .carte {

                    width: 100%;
                    margin-top: px;
                    background-color: #fff;
                    box-shadow: 0 3px 30px rgba(0, 0, 0, .14);
                    color: #000000;
                    text-align: center;
                    font-size: 16px;
                    padding:0px;
                }                
                .carte .carte-body {
                    padding: px;
                }               
                .carte .carte-footer {
                    display: table;
                    width: 100%;
                    border-top: 1px dotted black;
                }
                .carte .carte-footer .col {
                    display: table-cell;
                    padding: 5px;
                    font-size: 15px;
                }
                .carte .carte-footer .count {
                    font-size: 18px;
                    font-weight: 600;
                }
                .vr {
                    border-right: 1px dotted black;
                }
                .image{
                text-align:center ;
                }   
                .username{
                    font-size:20px ;
                }
                .qrcode-body{
                }
                .qrcode-child-l{
                padding-left:10%;
                float: left; width: 24%;
                transform: rotate(90deg);
                }
                .qrcode-child-r{
                padding-left : 3%;
                padding-top :-120px;
                float: right; 
                width: 30%;
                height:120px;
                transform: rotate(90deg);
                }
                .qrcode-image{
                }
                .full-name
                {
                    margin-left :30%;
                }
            </style>';
        
             $cover = asset('img/ticket-imag.png');
         $qrcode_image = asset('img/qrcode.svg');
         $current = date('Y-m-d H:i:s');


        $html =$style.' <div class="carte">
           <div class="carte-body">
              <div class="row">
                 <div class="col-md-2 image"><img src="'.$cover.'" width="100%"></div>
                 <div class="col-md-8">
                    <p class=""><strong>'.$current.'</strong>
                    </p>
                    <p class="username"><strong>Rencontres Equipe Nationale</strong></p>
                    <p class="city"><strong>ALGERIE VS ZIMBABWE</strong></p>
                 </div>
                 
                 <div class="qrcode-body">
                   
                    <div class="qrcode-child-l">
                       <span class="ticket-className detail" >Place : A002</span>
                       <span class="ticket-className detail" >Zone:10</span>                           
                    </div>

                    <div class="qrcode-child-r">
                       <span class="ticket-className detail" >Place : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; A002</span>
                       <span class="ticket-className detail" >Abdeldjallil SOAL</span>                           
                    </div>

                   
                    <div class="qrcode-image">
                        <img src="'.$qrcode_image.'" width="100px">
                    </div>
                    
                 </div>
                             
              </div>
           </div>

            <p class="full-name"><strong>'.$current.'</strong>
            </p>
           
           
           <div class="carte-footer" style="margin-top:30px;">
              <div class="col">
                 <p><span class="count"></span>'.$current.'</p>
             <p><span class="count"></span>ALGERIE - ZIMBABWE</p>
              </div>
           </div>
        </div>';
    
        $dompdf->loadHtml($html);
        $customPaper = array(0,0,290,480);
        $dompdf->setPaper($customPaper);
        $dompdf->render();
        $dompdf->stream("qrcode_".$qrcode, array('Attachment'=>0));       
    }

    
    
    public function caisse()
    {
        return view('caisse');
    }

    public function welcome()
    {
        $hotels = Admin::all();
        Alert::success('C\'est Fait', 'Votre Réservation a été efféctué Message');

        return view('index2',compact('hotels'));
    }

    public function index()
    {
        $encours = Reservation::where('etat','en cours')->get()->count();
        $enattente = Reservation::where('etat','en attente')->get()->count();
        $confirmer = Reservation::where('etat','confirmer')->get()->count();
        $terminer = Reservation::where('etat','terminer')->get()->count();
        
        return view('home',compact(
            'encours',
            'enattente',
            'confirmer',
            'terminer'    
        ));
    }

    public function search(Request $request)
    {
        $fin="";
        $debut="";
        $result = Reservation::query();
        $result2 = Presence::query();
        $result3 = Membre::query();

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
    }
}

