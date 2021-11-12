<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
        'client',
        'date',
        'numero',
        'inscription',
        'numerobc',
        'convention',
        'typo',
        'type',//tva wla timbre
        'ttc',
        'total',
        'etat'
    ];
    public function getClient()
    {
        return Client::where('id',$this->client)->first();
    }

    public function getItems()
    {
        Item::where('facture',$this->id)->get();
    }


    public function getTotal()
    {
        $items = Item::where('facture',$this->id)->get();
        $total = 0;
        $sous_total = 0;
        foreach($items as $item){
            $total = $total + $item->quantite*$item->prix;
        }
        return $total;
    }


    public static function asLetters($number,$separateur=",") 
    {    
      $convert = explode($separateur, $number);
      $mine = explode($separateur, $number)[0];
      $digit = ($mine[0]);
      $six = (strlen($mine));
      $num[17] = array('zero', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit',
                      'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize');
      $num[100] = array(20 => 'vingt', 30 => 'trente', 40 => 'quarante', 50 => 'cinquante',
                        60 => 'soixante', 70 => 'soixante-dix', 80 => 'quatre-vingt', 90 => 'quatre-vingt-dix');
      if (isset($convert[1]) && $convert[1] != '') {
        return Facture::asLetters($convert[0]).' virgule '.Facture::asLetters($convert[1]);
      }
      if ($number < 0) return 'moins '.Facture::asLetters(-$number);
      if ($number < 17) {
        return $num[17][$number];
      }
      elseif ($number < 20) {
        return 'dix-'.Facture::asLetters($number-10);
      }
      elseif ($number < 100) {
        if ($number%10 == 0) {
          return $num[100][$number];
        }
        elseif (substr($number, -1) == 1) {
          if( ((int)($number/10)*10)<70 ){
            return Facture::asLetters((int)($number/10)*10).'-et-un';
          }
          elseif ($number == 71) {
            return 'soixante-et-onze';
          }
          elseif ($number == 81) {
            return 'quatre-vingt-un';
          }
          elseif ($number == 91) {
            return 'quatre-vingt-onze';
          }
        }
        elseif ($number < 70) {
          return Facture::asLetters($number-$number%10).'-'.Facture::asLetters($number%10);
        }
        elseif ($number < 80) {
          return Facture::asLetters(60).'-'.Facture::asLetters($number%20);
        }
        else {
          return Facture::asLetters(80).'-'.Facture::asLetters($number%20);
        }
      }
      elseif ($number == 100) {
        return 'cent';
      }
      elseif ($number < 200) {
        return Facture::asLetters(100).' '.Facture::asLetters($number%100);
      }
      elseif ($number < 1000) {
        return Facture::asLetters((int)($number/100)).' '.Facture::asLetters(100).($number%100 > 0 ? ' '.Facture::asLetters($number%100): '');
      }
      elseif ($number == 1000){
        return 'mille';
      }
      elseif ($number < 2000) {
        return Facture::asLetters(1000).' '.Facture::asLetters($number%1000).' ';
      }
      elseif ($number < 1000000) {
        return Facture::asLetters((int)($number/1000)).' '.Facture::asLetters(1000).($number%1000 > 0 ? ' '.Facture::asLetters($number%1000): '');
      }
      elseif ($number == 1000000) 
      {
          
          if ($digit == 1 && $six == 7) 
          {
          
              return 'Un million';            

              # code...
          }

          return 'millions';
      }
      elseif ($number < 2000000) {
        return Facture::asLetters(1000000).' '.Facture::asLetters($number%1000000);
      }
      elseif ($number < 1000000000) {
        return Facture::asLetters((int)($number/1000000)).' '.Facture::asLetters(1000000).($number%1000000 > 0 ? ' '.Facture::asLetters($number%1000000): '');
      }
  }


    
    public static function template($facture) {
        $items= Item::where('facture',$facture->id)->get();
        $current = date('Y-m-d');
        $client = Client::find($facture->client);

        $type="";
        if($facture->typo=="proformat"){
            $type="Proformat";
        }
        $html = '<!doctype html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Facture </title>
        <style type="text/css">
            * {
                font-size:18px;
                font-family: Verdana, Arial, sans-serif;
            }

            div.page_break + div.page_break{
                page-break-before: always;
            }
            
            table{
            }
            tfoot tr td{
                font-weight: bold;
            }
            .attachments td{
                border:0.5px solid gray;
                box-sizing:border-box;
            }
            .attachments th{
                border:0.5px solid gray;
                box-sizing:border-box;
            }
        
            .gray {
                background-color: lightgray
            }
            .page-break {
                page-break-after: always;
           }               
        </style>
        
        </head>
        <body>
        
          <table width="100%">
            <tr>
                <td align="center" >
                    <h3>
                    Laboratoire de Contrôle et D\'analyse de Qualité & de Conformité
                    .<br></h3>
                        Tél / Fax:023 23 81 92 / Mobile : 0541 48 54 77 <br>
                        Email : altesselab@gmail.com<br>
                        Address: rue zabana en face a l\'hopital Frantz fanon, Blida 09000

                        <br>   
                </td>
    
            </tr>
        
          </table>
           <br>
          <table width="100%">
            <tr>
            <td><strong style="color:white;">Facture </strong></td>
            <td style="text-decoration:underline;" >
                <strong >Facture N°:'.$facture->id.' '.$type.'</strong> 
            </td>
            </tr>
    
          </table>
        
        <table width="100%">
            <tr>
                <td align="center" >
                    <h3>
                    '.$client->nom.'
                    .<br></h3>
                    '.$client->adresse.'
                        <br>   
                </td>    
            </tr>
        </table>

          <br/>
        
          <table width="100%" >
            <thead style="background-color: lightgray;">
              <tr>
                <th>Produit</th>
                <th>Analyse</th>
                <th>Parametre</th>
                <th>PU</th>
                <th>Quantite</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>';
            

            $total = 0;
            foreach($items as $key=>$item){
                    $index = $key +1;
                    $html.='<tr class="item">
                    <td align="center">
                        '.$item->produit.'
                    </td>
                    <td align="center">
                        '.str_replace("-","",$item->type).'
                    </td>
                    
                    <td align="center">
                        '.$item->setting.'
                    </td>
                    <td align="center">
                        '.$item->prix.'
                    </td>
                    <td align="center">
                    '.$item->quantite.'
                    </td>
                    <td align="center">
                    '.$item->prix*$item->quantite.'
                    </td>
                </tr>';
                $total +=$item->prix*$item->quantite;

            }
        $html.='
            </tbody>
            <tfoot>';
            if($facture->type == 'camion'){
                $sousTotal =$total;
                $total = $total-$facture->assurance - $facture->gaz - $facture->gps;

                $html.='                 
                <tr>
                    <td colspan="2"></td>
                    <td align="center">Sous Total</td>
                    <td align="center">'.$sousTotal.'</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td align="center"><hr style="color:#f5faf6;"></td>
                    <td align="center"><hr style="color:#f5faf6;"></td>
                </tr>
                
                <tr>
                    <td colspan="2"></td>
                    <td align="center">Assurance </td>
                    <td align="center">'.$facture->assurance.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">gaz </td>
                    <td align="center">'.$facture->gaz.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">gps </td>
                    <td align="center">'.$facture->gps.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Total TTC</td>
                    <td align="center">'.$total.'</td>
                </tr>

                ';
            }else{
            $html.='                 
                <tr style="padding-top:20px";>
                    <td colspan="4"></td>
                    <td align="center">Total HT </td>
                    <td align="center">'.$total.'</td>
                </tr>
                <tr style="padding-top:20px";>
                    <td colspan="4"></td>
                    <td align="center">TVA 19% </td>
                    <td align="center">'.($total*0.19).'</td>
                </tr>
                <tr style="padding-top:20px";>
                    <td colspan="4"></td>
                    <td align="center">Total TTC</td>
                    <td align="center">'.((float)$total + (float)($total*0.19)).'</td>
                </tr>';
            }
            $t = ((float)$total + (float)($total*0.19));
            $lettres = Facture::asLetters($t);

            $html.='</tfoot>
          </table>
        
          <table width="100%">

            <tr>
                <td><strong style="color:white;">Facture </strong></td>
                <td><strong style="color:white;">Facture </strong></td>
            </tr>
            <tr>
                <td><strong style="color:white;">Facture </strong></td>
                <td><strong style="color:white;">Facture </strong></td>
            </tr>
            <tr>
                <td>La présente facture est arrêté à la somme de :'.$lettres.'  </td>
            </tr>


        </table>
          <div class="page-break"></div>';
            

        $html.='</body></html>';


          

        return $html;

    }




    public static function proformat($facture) {
        $items= Item::where('facture',$facture->id)->get();
        $current = date('Y-m-d');
        $client = Client::find($facture->client);
        $html = '<!doctype html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Facture </title>
        <style type="text/css">
            * {
                font-size:13px;
                font-family: Verdana, Arial, sans-serif;
            }

            div.page_break + div.page_break{
                page-break-before: always;
            }
            
            table{
            }
            tfoot tr td{
                font-weight: bold;
            }
            .attachments td{
                border:0.5px solid gray;
                box-sizing:border-box;
            }
            .attachments th{
                border:0.5px solid gray;
                box-sizing:border-box;
            }
        
            .gray {
                background-color: lightgray
            }
            .page-break {
                page-break-after: always;
           }               
        </style>
        
        </head>
        <body>
        
          <table width="100%">
            <tr>

                <td align="center" >
                    <h3>
                    Laboratoire de Contrôle et D\'analyse de Qualité & de Conformité
                    .<br></h3>
                        Fax:035740082 <br>
                        bibanfretcompany@gmail.com<br>
                        Capital Social :2 000 000 DA<br>
                        Auxiliare de Transport Routier<br>
                        Agrément N°50/2017 du Ministre de transport 
                    <br>   
                </td>
    
            </tr>
        
          </table>
           <br>
          <table width="100%">
            <tr>
            <td><strong style="color:white;">Facture </strong></td>
            <td style="text-decoration:underline;" ><strong >Facture N°:'.$facture->id.'</strong> </td>

            </tr>
    
          </table>
        
          <table width="100%">
            <tr>
                <td><strong style="color:white;">Facture </strong></td>
                <td><strong style="color:white;">Facture </strong></td>
                <td><strong >'.$client->nom.'</strong></td>
            </tr>
            <tr>
                <td><strong style="color:white;">Facture </strong></td>
                <td><strong style="color:white;">Facture </strong></td>
                <td><strong >'.$client->adresse.'</strong></td>
            </tr>

        </table>

          <br/>
        
          <table width="100%" >
            <thead style="background-color: lightgray;">
              <tr>
                <th>Produit</th>
                <th>Analyse</th>
                <th>Parametre s</th>
                <th>PU</th>
                <th>Quantite</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>';

            $total = 0;
            foreach($items as $key=>$item){
                    $index = $key +1;
                    $html.='<tr class="item">
                    <td align="center">
                        '.$item->produit.'
                    </td>
                    <td align="center">
                        '.str_replace("-","sss",$item->type).'
                    </td>
                    
                    <td align="center">
                        '.$item->setting.'
                    </td>
                    <td align="center">
                        '.$item->prix.'
                    </td>
                    <td align="center">
                    '.$item->quantite.'
                    </td>
                    <td align="center">
                    '.$item->prix*$item->quantite.'
                    </td>
                </tr>';
                $total +=$item->prix*$item->quantite;

            }

        $html.='
            </tbody>
            <tfoot>';
            if($facture->type == 'camion'){
                $sousTotal =$total;
                $total = $total-$facture->assurance - $facture->gaz - $facture->gps;

                $html.='                 
                <tr>
                    <td colspan="2"></td>
                    <td align="center">Sous Total</td>
                    <td align="center">'.$sousTotal.'</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td align="center"><hr style="color:#f5faf6;"></td>
                    <td align="center"><hr style="color:#f5faf6;"></td>
                </tr>
                
                <tr>
                    <td colspan="2"></td>
                    <td align="center">Assurance </td>
                    <td align="center">'.$facture->assurance.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">gaz </td>
                    <td align="center">'.$facture->gaz.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">gps </td>
                    <td align="center">'.$facture->gps.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Total TTC</td>
                    <td align="center">'.$total.'</td>
                </tr>

                ';
            }else{
            $html.='                 
                <tr style="padding-top:20px";>
                    <td colspan="4"></td>
                    <td align="center">Total HT </td>
                    <td align="center">'.$total.'</td>
                </tr>
                <tr style="padding-top:20px";>
                    <td colspan="4"></td>
                    <td align="center">TVA 19% </td>
                    <td align="center">'.$facture->tva.'</td>
                </tr>
                <tr style="padding-top:20px";>
                    <td colspan="4"></td>
                    <td align="center">Total TTC</td>
                    <td align="center">'.((float)$total + (float)$facture->tva).'</td>
                </tr>';
            }
            $html.='</tfoot>
          </table>
        
          <table width="100%">

            <tr>
                <td><strong style="color:white;">Facture </strong></td>
                <td><strong style="color:white;">Facture </strong></td>
            </tr>
            <tr>
                <td><strong style="color:white;">Facture </strong></td>
                <td><strong style="color:white;">Facture </strong></td>
            </tr>
            <tr>
                <td><strong >La présente facture est arrêté à la somme de :</strong></td>
            </tr>


        </table>
          <div class="page-break"></div>';
            

        $html.='</body></html>';


          

        return $html;

    }





}
