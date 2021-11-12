@extends('layouts.master')



@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouveau Client  </h3></div>
                                    <div class="card-body">
                                        <form role="form" action="{{route('client.store')}}" method="post" id="formpost">
                                        @csrf
                                            <div class ="row">
                                                <!-- <div class ="col-sm-4">
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Catégorie</label>
                                                        <select class="form-control js-example-basic-multiple" multiple="multiple" name="categorie[]">
                                                            @foreach($categories as $categorie)
                                                            <option value="{{$categorie->id}}">{{$categorie->label}}</option>						 
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div> -->
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Nom</label>
                                                        <input type="text"  value="{{old('nom')}}" name="nom" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Tél</label>
                                                        <input type="text" value="{{old('telephone')}}" name="telephone" class="form-control">
                                                    </div>

                                                    



                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Adresse</label>
                                                        <input type="text" value="{{old('adresse')}}" name="adresse" class="form-control">
                                                    </div>
                                            
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Fax</label>
                                                        <input type="text" value="{{old('fax')}}" name="fax" class="form-control">
                                                    </div>

                                                
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >Wilaya</label>
                                                        <select class="form-control" value="{{old('wilaya')}}" name="wilaya">
                                                        @foreach($wilayas as $wilaya)
                                                            <option value="{{$wilaya->code}}">{{$wilaya->name ?? ''}}</option>	
                                                        @endforeach
                                                        </select>
                                                    </div>



                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >N° Registre</label>
                                                        <input type="text" id="n_registre" value="{{old('n_registre')}}" name="n_registre" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >N° Nif</label>
                                                        <input type="text" id="nif" value="{{old('nif')}}" name="nif" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >N° Nis</label>
                                                        <input type="text" id="nis" value="{{old('nis')}}" name="nis" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" >N° Article</label>
                                                        <input type="text" id="n_article" value="{{old('n_article')}}" name="n_article" class="form-control">
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
                                                <button id="valider"  class="btn btn-info btn-block">Valider</button>
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

});
</script>
@endsection



