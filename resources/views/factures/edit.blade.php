@extends('layouts.master')

@section('page_wrapper')
@endsection

@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Modifer Facture  </h3></div>
                                    <div class="card-body">
                                        <div class="leftSide"><!-- Begin of content -->
                                            <form action="{{route('facture.update',['facture'=>$facture->id])}}" id="Factureform" method="post">
                                            @csrf
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">client :</label>
                                                            <select class="form-control clients"  value="{{old('client')}}" name="client" >
                                                                    <option value="">séléctionner client</option>
                                                                    @foreach($clients as $client)
                                                                        <option @if($facture->client == $client->id) selected @endif value="{{$client->id}}">{{$client->nom}}</option>
                                                                    @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">Date Facture</label>
                                                        <input type="date" id="date" value="{{$facture->date}}" class="form-control" name="date">   
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <label for="">N° Facture</label>
                                                        <input type="text" id="numf"  value="{{$facture->numero ?? ''}}" name="numero" class="form-control numf">   
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">N° BC</label>
                                                        <input type="text" id="numbc" value="{{$facture->numerobc ?? ''}}" class="form-control" name="numerobc">   
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">N° Convention</label>
                                                        <input type="text" id="convetion"  class="form-control" value="{{$facture->convention ?? ''}}" name="convention">   
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
                                                            <input type="text"  value="{{$SelectedClient->raison_sociale}}" id="raison_sociale" name="raison_sociale" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Fax</label>
                                                        <input type="text" value="{{$SelectedClient->fax}}" id="fax" name="fax" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">


                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label style="font-size:15px;" >Téléphone :</label>
                                                            <input type="text" value="{{$SelectedClient->telephone}}" id="telephone" name="telephone" class="form-control">
                                                        </div>

                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label style="font-size:15px;" >N° Registre</label>
                                                            <input type="text" id="n_registre" value="{{$SelectedClient->n_registre}}" name="n_registre" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label style="font-size:15px;" >N° Nif</label>
                                                            <input type="text" id="nif" value="{{$SelectedClient->nif}}" name="nif" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label style="font-size:15px;" >N° Nis</label>
                                                            <input type="text" id="nis" value="{{$SelectedClient->nis}}" name="nis" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label style="font-size:15px;" >N° Article</label>
                                                            <input type="text" id="n_article" value="{{$SelectedClient->n_article}}" name="n_article" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>


                                                @foreach($items as $key=>$item)
                                                    <input value="{{$item->id}}" name="d[{{$key}}][id]" type="hidden" />
                                                        <div class="form-group" >
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <select class="form-control produits" id="produit" value="{{old('produit')}}" name="d[{{$key}}][produit]">
                                                                            <option value="">séléctionner Produit</option>
                                                                            @foreach($produits as $produit)
                                                                                <option @if($produit->id == $item->produit) selected @endif value="{{$produit->id}}">{{$produit->designation}}</option>
                                                                            @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select class="form-control types" id="type" value="{{old('type')}}" name="d[{{$key}}][type]">
                                                                            <option value="">séléctionner type</option>
                                                                            <option value="micro" @if($item->type == "micro") selected @endif>Micro Bio</option>
                                                                            <option value="physico" @if($item->type == "physico") selected @endif>Physico </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select class="form-control settings" id="setting" value="{{old('setting')}}" name="d[{{$key}}][setting]">
                                                                            <option value="">séléctionner paramètre</option>
                                                                            @foreach($settings as $setting)
                                                                                <option @if($setting->id == $item->setting) selected @endif value="{{$setting->id}}">{{$setting->determination}}</option>
                                                                            @endforeach
                                                                    </select>

                                                                </div>
                                                                <div class="col-md-1">
                                                                    <input type="number" class="form-control"  id="prix" placeholder="Prix" value="{{$item->prix}}" name="d[{{$key}}][prix]" >
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="number" class="form-control"  id="quantite" placeholder="Quantité" value="{{$item->quantite}}" name="d[{{$key}}][quantite]" >
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="number" class="form-control" name="montant" id="montant" readonly placeholder="montant" >
                                                                </div>
                                                                <div class="button-group">
                                                                    <a href="javascript:void(0)" class="btn btn-primary" id="plus5"><i class="fa fa-plus"></i></a>
                                                                    <a href="javascript:void(0)" class="btn btn-danger" id="minus5"><i class="fa fa-minus"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endforeach




                                                <div class="form-group" id="dynamic_form">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <select class="form-control produits" id="produit" value="{{old('produit')}}" name="produit">
                                                                    <option value="">séléctionner Produit</option>
                                                                    @foreach($produits as $produit)
                                                                        <option value="{{$produit->id}}">{{$produit->designation}}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>


                                                        <div class="col-md-2">
                                                            <select class="form-control types" id="type" value="{{old('type')}}" name="type">
                                                                    <option value="">séléctionner type</option>
                                                                    <option value="micro">Micro Bio</option>
                                                                    <option value="physico">Physico </option>

                                                            </select>
                                                        </div>


                                                        <div class="col-md-2">
                                                            <select class="form-control settings" id="setting" value="{{old('setting')}}" name="setting">
                                                                    <option value="">séléctionner paramètre</option>
                                                                    @foreach($settings as $setting)
                                                                        <option value="{{$setting}}">{{$setting->determination}}</option>
                                                                    @endforeach
                                                            </select>

                                                        </div>
                                                        <div class="col-md-1">
                                                            <input type="number" class="form-control" name="prix" id="prix" placeholder="Prix" >
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="number" class="form-control" name="quantite" id="quantite" placeholder="Quantité" >
                                                        </div>

                                                        <div class="col-md-2">
                                                            <input type="number" class="form-control" name="montant" id="montant" readonly placeholder="montant" >
                                                        </div>
                                                        <div class="button-group">
                                                            <a href="javascript:void(0)" class="btn btn-primary" id="plus5"><i class="fa fa-plus"></i></a>
                                                            <a href="javascript:void(0)" class="btn btn-danger" id="minus5"><i class="fa fa-minus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <button class="btn btn-info" id="calculer">Calculer Total</button>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">TOTAL HT :<span style="text-align:right;" id="total"></span> {{$facture->getTotal()}}  DA</li>
                                                        <li class="list-group-item">TVA : <span style="text-align:right;" id="tva"></span>  DA</li>
                                                        <li class="list-group-item">Timbre : <span style="text-align:right;" id="timbre"></span>  DA</li>
                                                        <li class="list-group-item">Total TTC : <span style="text-align:right;" id="ttc"></span>  DA</li>
                                                    </ul>
                                                </div>
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
            var values = {};
            $.each($('#Factureform').serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            console.log(values)
            $.ajax({
                type: 'POST', //THIS NEEDS TO BE GET
                url: '/facture/calculer',
                data: {_token: CSRF_TOKEN, data:values},
                dataType: 'JSON',
                success: function (data) {
                    console.log(data)
                    $('#tva').html(data.tva)
                    $('#ttc').html(data.ttc)
                    $('#total').html(data.total)
                },
                error: function(err) { 
                    console.log(err);
                }
            });
        })
        var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus5", "#minus5", {
            limit:10,
            formPrefix : "dynamic_form",
            normalizeFullForm : false
        });

    //    dynamic_form.inject([{p_name: 'Hemant',quantity: '123',remarks: 'testing remark'},{p_name: 'Harshal',quantity: '123',remarks: 'testing remark'}]);

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
        $('.settings').on('change',function(e){
            var valueSelected = this.value;
            var index = this.id
            var t = index.length-1
            var setting = JSON.parse(valueSelected);
            var prix  = setting.prix;
            index  = index[t]
            $('#prix'+index).val(prix)
        })


});

</script>
@endsection