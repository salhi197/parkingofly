<?php

namespace App\Http\Controllers;

use Auth;
use App\Type;
use App\Camion;
use App\Commune;
use App\Item;
use App\Attachement; 
use App\Wilaya;
use App\Facture;

use App\Payment;

use Carbon\Carbon;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Client;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    
    public function index() 
    {   
        $payments = Payment::all();

        return view('payments.index',compact('payments'));
    }


    public function facture($id_facture)
    {   
        $facture= Facture::find($id_facture);
        $client = Client::find($facture->client);
        $payments = Payment::where('facture',$id_facture)->get();
        $payed = Payment::where('facture',$id_facture)->sum('montant');

        return view('payments.facture',compact('payments','facture','payed','client'));
    }

    public function create()
    {
        return view('payments.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment  = new Payment();
        $payment->montant = $request['montant']; 
        $payment->reservation = $request['reservation']; 
        $payment->type = $request['type'];
        $payment->date_payment = $request['date_payment'];
        if ($request->hasFile('recu')) {
            $payment->recu = $request->file('recu')->store(
                'payments/recu',
                'public'
            );
        }

        $payment->save();
        return redirect()->route('reservation.index')->with('success', 'Payment Inséré  !  ');
    }

    public function filter(Request $request)
    {
        $wheres = "";
        $index = 0;
        $type = "";
        $debut_entre = "";
        $fin_entre ="";
        if($request['debut_entre']){
            $debut_entre = $request['debut_entre'];
            if($index==0){
                $wheres =$wheres."where date_payment >= '$debut_entre'";
                $index = 2;
            }else{
                $wheres =$wheres."and date_payment >= '$debut_entre'";
                $index=2;
            }
        }
        if($request['fin_entre']){
            $fin_entre = $request['fin_entre'];
            if($index>0){
                $wheres =$wheres." and date_payment <= '$fin_entre'";
            }else{
                $wheres =$wheres."where date_payment <= '$fin_entre'";
            }
        }
        $sql = "select * from payments ";
        $sql = $sql.$wheres;
        
        // $sql = $sql.' group by a.adresse,a.ville';
        $payments=DB::select(DB::raw($sql));
        return view('payments.index',compact('payments','fin_entre','debut_entre'));        
    }




}
