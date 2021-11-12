<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Reservation;
use Mail;
use App\Template;
use Carbon\Carbon;
use Storage;
use Dompdf\Dompdf;
use App\Fournisseur;
use App\Setting;
use App\Payment;
use Illuminate\Http\Request;
use DB;
class ReservationController extends Controller
{
    public function valider($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        $reservation->etat = "Valider";
        $reservation->save();
        $data = [
            'subject' => 'Ticket de Reservation',
            'email' => "salhihaider197@gmail.com",
            'content' => "Hi there Hhhh",
            'qrcode'=>$reservation->qrcode,
            'ticket'=>$reservation->ticket,
            'debut'=>$reservation->debut,
            'fin'=>$reservation->fin       
          ];
        $logo=[
            'path'=>'haider ali'
        ];
        Mail::send('email', ['data'=>$data,'css'=>'','logo'=>$logo,'unsubscribe'=>''], function($message) use ($data) {
            $message->to($data['email'])
            ->subject('Ticket de reservation');
          });
        return redirect()->route('reservation.index')->with('success', 'Reservation a été Validé ');
        
    }
    public function filter(Request $request)
    {
        $result = Reservation::query();
        $date_fin="";
        $date_debut="";

        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('debut', '>=', $request['date_debut']);
        }
    
        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('fin', '<=', $request['date_fin']);
        }

        if (!empty($request['etat'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->where('etat', '=', $request['etat']);
        }

        if (!empty($request['hotel'])) {
            $date_fin=$request['hotel'];    
            $result = $result->where('fin', '=', $request['hotel']);
        }
        $reservations = $result->get();
        return view('reservations.index',compact('reservations',
            'state',
            'date_debut',
            'date_fin'
        ));

    }

    public function search(Request $request)
    {
        $debut = $request['debut'];
        $fin = $request['fin'];
        $tarif = 1500;
        // $places = DB::select("SELECT * from places p where hotel=1 and p.id not in 
        //     (select place from reservations r where 
        //         (debut=>$debut and fin<=$fin)
        //         or
        //         ($debut<=debut and $fin=>fin)
        //         or
        //         ($debut<=fin and $fin=>fin)
        //         or
        //         ($debut=>debut and $fin<=fin)
        //     );
        //     ");
        
        $places = DB::select("SELECT * from places p where hotel=1 and p.id not in (select place from reservations r where debut>$debut and fin<$fin);");

        $debut = Carbon::parse($debut);
        $fin = Carbon::parse($fin);
        $diff = $debut->diffInDays($fin);
        $total = $tarif*$diff;
        $debut = $request['debut'];
        $fin = $request['fin'];


        return view('reservations.create',compact('places',
                "debut",
                "fin",
                "total"
        ));
    }




    public function index()
    {
        $reservations = Reservation::all();
        $state ="-1";
        $date_fin="";
        $date_debut="";
        return view('reservations.index',compact('reservations','state','date_debut','date_fin'));
    }
    public function create()
    {
        return view('reservations.create');
    }

    public function ticket()
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
        return view('reser$reservations.view',compact('produit'));
    }
    public function store(Request $request)
    {
        $reservation = new Reservation();   
        $reservation->hotel = $request['hotel'] ?? '';  
        $reservation->place = $request['place'] ?? '1';      
        $reservation->nom = $request['nom'];
        $reservation->prenom = $request['prenom'];
        $reservation->email = $request['email'];
        $reservation->telephone = $request['telephone'];
        $reservation->adress = $request['adress'];
        $reservation->matricule = $request['matricule'];
        $reservation->etat = "en cours";
        /**
        * lzm nzid tarif psk rah ytbdl donc
         */
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
        $html = Template::templateTicket();        
        $dompdf->loadHtml($html);
        $customPaper = array(0,0,290,480);
        $dompdf->setPaper($customPaper);
        $dompdf->render();
        $content = $dompdf->output();
        $file = $dompdf->output();
        Storage::put('public/file_'.$qrcode.'.pdf', $file);
        $reservation->ticket = 'public/file_'.$qrcode.'.pdf';
        $reservation->qrcode = $timestamp;
        $setting = Setting::find(1);
        $tarif = $setting['value'];

        $reservation->tarif = $tarif;        

        $reservation->debut = $request['debut'];
        $reservation->fin = $request['fin'];
        $reservation->save();
  
        return redirect()->route('welcome')->with('success', 'reservation inséré avec succés ');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produit  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_reservation)
    {
        $reservation = Reservation::find($id_reservation);
        $reservation->delete();
        return redirect()->route('reservation.index')->with('success', 'le Produit a été supprimé ');        
    }

    public function setState($id_reservation,$state)
    {
        $reservation = Reservation::find($id_reservation);
        $reservation->state= $state;
        $reservation->save();
        return redirect()->route('reservation.index')->with('success', 'Etat de Réservation a été changé  ');
    }
    public function caisse()
    {
        $paiments = Payment::all();
        $filtered  = 0;
        $total = Payment::sum('montant');
        $totalToday = Payment::where('created_at', '>=', Carbon::today())->sum('montant');
        return view('reservations.caisse',compact('paiments','total','totalToday','filtered'));
    }
    public function caisseFilter(Request $request)
    {
        $result = Payment::query();
        $date_fin="";
        $date_debut="";

        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('date_payment', '>=', $request['date_debut']);
        }
    
        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('date_payment', '<=', $request['date_fin']);
        }

        if (!empty($request['etat'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->where('etat', '=', $request['etat']);
        }

        if (!empty($request['hotel'])) {
            $date_fin=$request['hotel'];    
            $result = $result->where('fin', '=', $request['hotel']);
        }
        $paiments = $result->get();
        $filtered  = 0;
        $total = Payment::sum('montant');
        $totalToday = Payment::where('created_at', '>=', Carbon::today())->sum('montant');

        return view('reservations.caisse',compact('paiments','total','totalToday','filtered'));
    }




}