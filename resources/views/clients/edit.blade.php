@extends('layouts.master')



@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Modifier Client  </h3></div>
                                    <div class="card-body">
                                        <form role="form" action="{{route('client.update',['client'=>$client->id])}}" method="post">
                                        @csrf
                                            <div class ="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="SARL">SARL</option>						 
                                                            <option value="EURL">EURL</option>						 
                                                            <option value="PME">PME</option>						 
                                                            <option value="Autre">Autre</option>						 
                                                        </select>

                                                    </div>
                                                </div>


                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Raison sociale</label>
                                                        <input type="text"  value="{{$client->raison_sociale ?? ''}}" id="raison_sociale" name="raison_sociale" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">

                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Fax</label>
                                                        <input type="text" value="{{$client->fax ?? ''}}" name="fax" class="form-control">
                                                    </div>


                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Wilaya</label>
                                                        <select class="form-control" value="{{$client->wilaya ?? ''}}" name="wilaya">
                                                        @foreach($wilayas as $wilaya)
                                                            <option value="{{$wilaya->code}}">{{$wilaya->name ?? ''}}</option>	
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Tél</label>
                                                        <input type="text" value="{{$client->telephone ?? ''}}" name="telephone" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Adresse</label>
                                                        <input type="text" value="{{$client->adresse ?? ''}}" name="adresse" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Nom</label>
                                                        <input type="text"  value="{{$client->nom ?? ''}}" name="nom" class="form-control">
                                                    </div>
                                                
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >N° Registre</label>
                                                        <input type="text" id="n_registre" value="{{$client->n_registre ?? ''}}" name="n_registre" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >N° Nif</label>
                                                        <input type="text" id="nif" value="{{$client->nif ?? ''}}" name="nif" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >N° Nis</label>
                                                        <input type="text" id="nis" value="{{$client->nis ?? ''}}" name="nis" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >N° Article</label>
                                                        <input type="text" id="n_article" value="{{$client->n_article ?? ''}}" name="n_article" class="form-control">
                                                    </div>
                                                </div>


                                            </div>

                                        <div class="row">
                                                
                                            <!-- <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label style="font-size:15px;" >Mot de passe</label>
                                                    <input type="password"  name="password" class="form-control">
                                                </div>
                                            </div> -->
                                                <!-- <div class ="col-sm-4">
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Type</label>
                                                        <select class="form-control" name="type">
                                                            <option value="bis">bis</option>						 
                                                            <option value="standard">standard</option>						                                                             
                                                        </select>
                                                    </div>
                                                </div> -->

                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button type="submit"  class="btn btn-info btn-block">Valider</button>
                                            </div>
                                        </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
@section('scripts')
<script>

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    $("#valider").on('click',function(e){
        console.log('te')        
        e.preventDefault();
        var raison_sociale = $('#raison_sociale').val()
        var n_registre = $('#n_registre').val()
        var nif = $('#nif').val()
        var nis = $('#nis').val()
        var n_article = $('#n_article').val()
        var valider = true;
        console.log(valider)

        if(raison_sociale.length > 0){
            console.log('dzdzd')
            if(n_registre.length==0){
                toastr.error('n_rene peut pas etre est vide')
                valider = false;
            }
            if(nif.length==0){
                toastr.error('nif ne peut pas etre vide')
                valider = false;
            }
            if(nis.length==0){
                toastr.error('nis ne peut pas etre vide')
                valider = false;
            }
            if(n_article.length==0){
                toastr.error('n_arne peut pas etre est vide')
                valider = false;
            }             
        }
        if(valider){
            $("#formpost").submit()
        }

    });    

});
</script>
@endsection



