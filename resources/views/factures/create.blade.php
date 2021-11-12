@extends('layouts.master')

@section('page_wrapper')
@endsection

@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouvelle Facture  pour le client : {{$client->nom  ?? $client->raison_sociale}} , Du {{$date_debut}} Au {{$date_fin}}</h3></div>
                                    <div class="card-body">
                                        <div class="leftSide"><!-- Begin of content -->
                                            <form action="{{route('facture.store')}}" id="Factureform" method="post">
                                            @csrf
                                                <div class="row">


                                                    <div class="col-sm-3">         
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="type" id="type1" value="facture" checked>
                                                            <label class="form-check-label" for="type1">
                                                                Facture
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="type" id="type2" value="proformat">
                                                            <label class="form-check-label" for="type2">
                                                                Facture Proformat
                                                            </label>
                                                        </div>


                                                    </div>


                                                    <div class="col-sm-2">
                                                        <label for="">Date Facture</label>
                                                        <input type="date" id="date" value="{{date('Y-m-d')}}" class="form-control" name="date">   
                                                    </div>
                                                        <input type="hidden" id="client" value="{{$client->id}}" class="form-control" name="client">   

                                                    <!-- <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">client :</label>
                                                            <select class="form-control clients"  value="{{old('client')}}" name="client" >
                                                                    <option value="">séléctionner client</option>
                                                                    @foreach($clients as $client)
                                                                        <option value="{{$client->id}}">{{$client->nom}}</option>
                                                                    @endforeach
                                                            </select>

                                                        </div>
                                                    </div> -->

                                                    <div class="col-sm-2">
                                                        <label for="">N° Facture</label>
                                                        <input type="text" id="numf"  value="{{old('numero') ?? $maxValue}}" name="numero" class="form-control numf">   
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">N° BC</label>
                                                        <input type="text" id="numbc" value="{{old('numbc')}}" class="form-control" name="numerobc">   
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">N° Convention</label>
                                                        <input type="text" id="convetion"  class="form-control" value="{{old('convention')}}" name="convention">   
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="type"  value="tva" @if(old('type')== 'tva') checked @endif> Tva
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="type" id="timbre" @if(old('type')== 'timbre') checked @endif value="timbre"> Timbre
                                                            </label>
                                                        </div>   
                                                    </div>
                                                </div>


                                                <div class="row">


                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label style="font-size:15px;" >Raison sociale</label>
                                                            <input type="text"  value="{{$client->raison_sociale }}" id="raison_sociale" name="raison_sociale" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Fax</label>
                                                        <input type="text" value="{{$client->fax }}" id="fax" name="fax" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">


                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label style="font-size:15px;" >Téléphone :</label>
                                                            <input type="text" value="{{$client->telephone }}" id="telephone" name="telephone" class="form-control">
                                                        </div>

                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label style="font-size:15px;" >N° Registre Commerce</label>
                                                            <input type="text" id="n_registre" value="{{$client->n_registre }}" name="n_registre" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label style="font-size:15px;" >N° Nif</label>
                                                            <input type="text" id="nif" value="{{$client->nif }}" name="nif" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label style="font-size:15px;" >N° Nis</label>
                                                            <input type="text" id="nis" value="{{$client->nis }}" name="nis" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label style="font-size:15px;" >N° Article</label>
                                                            <input type="text" id="n_article" value="{{$client->n_article }}" name="n_article" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>


                                            <?php
                                                $index = 0;
                                            ?>
                                                @foreach($analyses as $analyse)
                                               Analyse Code : {{$analyse->code1 ?? $analyse->code2 ?? ''}}
                                                    <?php
                                                        if($analyse->type_analyse_1 == 1){
                                                            $type = "Physico-chimique";
                                                            $elements= $analyse->getElements();
                                                        }
                                                        if($analyse->type_analyse_2 == 1){
                                                            $type = "Micro-biologique";
                                                            $elements= $analyse->getElements2();
                                                        }                                                
                                                    ?>
                                                        @foreach($elements as $key=>$element)
                                                            <?php 
                                                                $index+=1;
                                                            ?>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <input class="form-control" value="{{$type}}" name="d2[{{$index}}][type]"/>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input class="form-control" value="{{$analyse->getProduit()['designation'] }}" name="d2[{{$index}}][produit]"/>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input class="form-control" value="{{$analyse->code1 ?? $analyse->code2 ?? ''}}" name="d2[{{$index}}][analyse]"/>

                                                                </div>

                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                        <input class="form-control" value="{{$element->parametre}}" name="d2[{{$index}}][setting]"/>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="col-md-1    ">
                                                                    <input type="number" class="form-control" id="prix_quantite{{$index}}" name="d2[{{$index}}][prix]" id="prix" placeholder="Prix" >
                                                                </div>
                                                                <div class="col-md-1    ">
                                                                    <input type="number" class="form-control quantities" name="d2[{{$index}}][quantite]" id="quantite{{$index}}" placeholder="Quantité" onchange="" >
                                                                </div>
                                                                <div class="col-md-2    ">
                                                                    <input type="number" class="form-control montants" name="montant"   readonly id="montant_quantite{{$index}}" />
                                                                </div>
                                                            </div>
                                                        @endforeach                                                    
                                                @endforeach


                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <button class="btn btn-info" id="calculer">Calculer Total</button>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" name="total_lettre">La présente facture est arrêté à la somme de :</textarea>
                                                    </div>
                                                </div>
                                                <br>

                                                <table align="center" border="0" style="font-family: 'Montserrat', sans-serif;" cellpadding="0" cellspacing="0" width="1200px">
                                                    <tbody>
                                                        <tr style="text-align: right;">

                                                            <td style="padding:10px 0; ">
                                                                <h4><strong style="margin-right: 20px;"> Total HT</strong> <span id="total">0.00</span> </h4>
                                                                <h4><strong style="margin-right: 20px;">  TVA</strong> <span id="tva">0.00</span> </h4>
                                                                <h4><strong style="margin-right: 20px;"> Timbre</strong> <span id="timbre">0.00</span> </h4>
                                                                <h4><strong style="margin-right: 20px;"> Total TTC</strong> <span id="ttc">0.00</span> </h4>
                                                            </td>
                                                        </tr>
                                                        <tr style="text-align: right; ">

                                                            <td style="padding:10px 0; border-bottom:1px solid #000;">
                                                                <p style=" margin-top: 150px; font-size: 14px;">
                                                                laboratoire de contrôle de qualité Altesse lab  
                                                                </p>
                                                            </td>
                                                        </tr>


                                                    </tbody>
                                                </table>


                                                <br>

                                                    <button class="btn btn-info" type="submit">valider</button>
                                           </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    









@endsection



@section('scripts')
<script>

$(document).ready(function() {
    $('.quantities').on('change',function(){
        var id = this.id
        var val = this.value
        var qte = $('#prix_'+id).val();
        var montant = $('#prix_'+id).val()*val
        $('#montant_'+id).val(montant)
        console.log(id,val,qte,montant)
    })
    var clients  = {!! json_encode($clients->toArray()) !!};
    $('.clients').on('change',function(){
        var valueSelected = this.value;
        const found = clients.find(element => element.id == valueSelected);
        console.log(found)
        $('#raison_sociale').val(found.raison_sociale)
        $('#fax').val(found.fax)
        $('#telephone').val(found.telephone)
        $('#n_registre').val(found.n_registre)
        $('#nif').val(found.nif)
        $('#nis').val(found.nis)
        $('#n_article').val(found.n_article)
    })
//    $('.settings').select2();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#calculer').on('click',function(e){
             e.preventDefault()
            var sum = 0;
             $('.montants').each(function(){
                sum += parseInt(this.value);
            });             
            var tva = sum*0.19;
            var ttc = sum+sum*0.19;
            var total = sum*0.19;
                    $('#tva').html(tva.toFixed(2))
                    $('#ttc').html(ttc.toFixed(2))
                    $('#total').html(sum)


//             var values = {};
//             $.each($('#Factureform').serializeArray(), function(i, field) {
//                 values[field.name] = field.value;
//                 console.log("asa")
//             });
//             console.log(values)
//             $.ajax({
//                 type: 'POST', //THIS NEEDS TO BE GET
//                 url: '/facture/calculer',
//                 data: {_token: CSRF_TOKEN, data:values},
//                 dataType: 'JSON',
//                 success: function (data) {
// //                    console.log(data)
//                     $('#tva').html(data.tva)
//                     $('#ttc').html(data.ttc)
//                     $('#total').html(data.total)
//                 },
//                 error: function(err) { 
//                     console.log(err);
//                 }
//             });
        })
        var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus5", "#minus5", {
            limit:10,
            formPrefix : "dynamic_form",
            normalizeFullForm : false
        });


        $("#dynamic_form #minus5").on('click', function(){
            var initDynamicId = $(this).closest('#dynamic_form').parent().find("[id^='dynamic_form']").length;
            if (initDynamicId === 2) {
                $(this).closest('#dynamic_form').next().find('#minus5').hide();
            }
            $(this).closest('#dynamic_form').remove();
        });

        $('form').on('submit', function(event){
            var values = {};
            $.each($('form').serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            // console.log(values)
            // event.preventDefault();
        })

        $(document).on('change', '.types', function(e) {
            var id = this.id;
            var l = id.length
            var valueSelected = this.value;
            console.log(valueSelected,id)
            if(valueSelected =="micro"){
                $("#setting"+index).append(('<option value="'+found.reference+'" selected="selected">'+found.reference+'</option>'));
            }
        })



        var settings  = {!! json_encode($settings->toArray()) !!};
        $(document).on('change', '.settings', function(e) {
            var valueSelected = this.value;
            valueSelected = settings.find(element => element.id == valueSelected);
            console.log(valueSelected)
            var index = this.id
            var t = index.length-1
            var prix  = valueSelected.prix;
            index  = index[t]
            $('#prix'+index).val(prix)
        })
});

</script>
@endsection