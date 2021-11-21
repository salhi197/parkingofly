<?php

namespace App;

use App\Http\Controllers\ReservationController;
use App\Produit;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{

    public static function templateTicket() {
        $current = date('Y-m-d');
        $qrcode = asset('/img/1636877747.svg');
        $html='
        <!doctype html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Ticket Template</title>
        
        <style type="text/css">
            * {
                font-family: Verdana, Arial, sans-serif;
            }
            table{
                font-size: x-small;
            }
            tfoot tr td{
                font-weight: bold;
                font-size: x-small;
            }
        
            .gray {
                background-color: lightgray
            }
        </style>
        
        </head>
        <body>
        
          <table width="100%">
            <tr>
                <td valign="top"></td>
                <td align="center">
                    <h3>Parking Go Fly Hani</h3>
                    <h3>Ticket de Réservation </h3>

                </td>
            </tr>
        
          </table>
        
          <table width="100%">
            <tr align="center">
                <td>Salhi Haider Ali</td>
            </tr>
        
          </table>

          <table width="100%">
          <tr>
              <td>Date et Heure D\'entrée : </td>
              <td> Linblum - Barrio </td>
          </tr>

          <tr>
              <td>Date et Heure de Sortie : </td>
              <td> Linblum - Barrio Comercial</td>
          </tr>
          <tr>
              <td>Téléphone : </td>
              <td> Linblum - Barrio </td>
          </tr>
          <tr>
              <td>Email : </td>
              <td> Linblum - Barrio Comercial</td>
          </tr>
          <tr>
              <td>Linblum - Barrio teatral</td>
              <td> Linblum - Barrio Comercial</td>
          </tr>
          <tr>
              <td>Linblum - Barrio teatral</td>
              <td> Linblum - Barrio Comercial</td>
          </tr>
          <tr width="100%;backgroud:red;">
              <td align="center">
                <h3>
                    Merci Pour Votre Confiance 
                </h3>
              </td>
          </tr>

        </table>


          <br/>
        

        </body>
        </html>        
        ';
                
        return $html;

    }

    
    public static function qrcode()
    {
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
        return $html;

    }


}
