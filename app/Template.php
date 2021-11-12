<?php

namespace App;

use App\Http\Controllers\ReservationController;
use App\Produit;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{

    public static function templateTicket() {
        $current = date('Y-m-d');

        $html='
        <html style="page-break-before: always;">
        <head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
        <style type="text/css">
        @page { size: 215pt 215pt;margin:0; }
        span.cls_008{font-family:"Trebuchet MS",serif;font-size:7.0px;color:rgb(24,24,24);font-weight:normal;font-style:normal;text-decoration: none}
        div.cls_008{font-family:"Trebuchet MS",serif;font-size:7.0px;color:rgb(24,24,24);font-weight:normal;font-style:normal;text-decoration: none}
        span.cls_003{font-family:"Trebuchet MS",serif;font-size:9.1px;color:rgb(24,24,24);font-weight:normal;font-style:normal;text-decoration: none}
        div.cls_003{font-family:"Trebuchet MS",serif;font-size:9.1px;color:rgb(24,24,24);font-weight:normal;font-style:normal;text-decoration: none}
        span.cls_004{font-family:"Trebuchet MS Bold",serif;font-size:10.1px;color:rgb(24,24,24);font-weight:bold;font-style:normal;text-decoration: none}
        div.cls_004{font-family:"Trebuchet MS Bold",serif;font-size:10.1px;color:rgb(24,24,24);font-weight:bold;font-style:normal;text-decoration: none}
        span.cls_002{font-family:"Trebuchet MS Bold",serif;font-size:48.0px;color:rgb(24,24,24);font-weight:bold;font-style:normal;text-decoration: none}
        div.cls_002{font-family:"Trebuchet MS Bold",serif;font-size:48.0px;color:rgb(24,24,24);font-weight:bold;font-style:normal;text-decoration: none}
        span.cls_005{font-family:"Trebuchet MS Bold",serif;font-size:14.1px;color:rgb(24,24,24);font-weight:bold;font-style:normal;text-decoration: none}
        div.cls_005{font-family:"Trebuchet MS Bold",serif;font-size:14.1px;color:rgb(24,24,24);font-weight:bold;font-style:normal;text-decoration: none}
        span.cls_006{font-family:"Trebuchet MS Bold",serif;font-size:9.1px;color:rgb(24,24,24);font-weight:bold;font-style:normal;text-decoration: none}
        div.cls_006{font-family:"Trebuchet MS Bold",serif;font-size:9.1px;color:rgb(24,24,24);font-weight:bold;font-style:normal;text-decoration: none}
        span.cls_007{font-family:"Trebuchet MS",serif;font-size:8.1px;color:rgb(24,24,24);font-weight:normal;font-style:normal;text-decoration: none}
        div.cls_007{font-family:"Trebuchet MS",serif;font-size:8.1px;color:rgb(24,24,24);font-weight:normal;font-style:normal;text-decoration: none}
        span.cls_009{font-family:"Trebuchet MS",serif;font-size:12.1px;color:rgb(24,24,24);font-weight:normal;font-style:normal;text-decoration: none}
        div.cls_009{font-family:"Trebuchet MS",serif;font-size:12.1px;color:rgb(24,24,24);font-weight:normal;font-style:normal;text-decoration: none}
        </style>
        <script type="text/javascript" src="525ab86c-3723-11eb-8b25-0cc47a792c0a_id_525ab86c-3723-11eb-8b25-0cc47a792c0a_files/wz_jsgraphics.js"></script>
        </head>
        <body>
        <div style="position:absolute;left:50%;margin-left:-141px;top:0px;width:283px;height:283px;overflow:hidden">
        <div style="position:absolute;left:0px;top:0px">
        <img src="'.asset("img/background3.jpg").'" width=283 height=283></div>
        <div style="position:absolute;left:218.88px;top:45.41px" class="cls_008"><span style="font-size:11px;" class="cls_008"></span></div>
        <div style="position:absolute;left:222.88px;top:65.41px" class="cls_008"><span style="font-size:11px;" class="cls_008">'.$current.'</span></div>
        <div style="position:absolute;left:44.16px;top:11.65px" class="cls_003"><span class="cls_003">Fournisseur : </span></div>
        <div style="position:absolute;left:92.16px;top:11.65px" class="cls_003"><span class="cls_003"></span></div>
        <div style="position:absolute;left:20.76px;top:45.73px" class="cls_003"><span class="cls_003">N° Service Client</span></div>
        <div style="position:absolute;left:90.32px;top:45.21px" class="cls_004"><span class="cls_004"></span></div>
        <div style="position:absolute;left:210.24px;top:50.33px" class="cls_002"><span class="cls_002"></span></div>
        <div style="position:absolute;left:47.04px;top:75.01px" class="cls_003"><span class="cls_003">Nom: </span></div>
        <div style="position:absolute;left:220.24px;top:79.77px; class="cls_006"><span style="font-size:40px;" class="cls_006"></span></div>
        <div style="position:absolute;left:148.80px;top:85.57px" class="cls_003"><span class="cls_003">Fragile</span></div>
        <div style="position:absolute;left:47.04px;top:96.13px" class="cls_003"><span class="cls_003"></span></div>
        <div style="position:absolute;left:17.28px;top:120.65px" class="cls_007"><span class="cls_007">Produit</span></div>
        <div style="position:absolute;left:125.44px;top:120.65px" class="cls_007"><span class="cls_007">Qtn</span></div>
        <div style="position:absolute;left:150.44px;top:120.65px" class="cls_007"><span class="cls_007">prix</span></div>
        ';
                
        $html=$html.'<div style="position:absolute;left:220.24px;top:153.29px" class="cls_007"><span class="cls_007"></span></div>
        <div style="position:absolute;left:54.72px;top:200.17px" class="cls_009"><span class="cls_009">Total</span></div>
        <div style="position:absolute;left:96.96px;top:200.17px" class="cls_009"><span class="cls_009">Da</span></div>
        <div style="position:absolute;left:49.92px;top:224.29px" class="cls_003"><span class="cls_003">++++++++++++++++++++++++</span></div>
        <div style="position:absolute;left:50.88px;top:241.57px" class="cls_006"><span class="cls_006">Aucun Article a Recuperer</span></div>
        </div>    
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
