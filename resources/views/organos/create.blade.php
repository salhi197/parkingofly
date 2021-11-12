@extends('layouts.master')

@section('page_wrapper')
@include('includes.settings')
@endsection

@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouvelle Reference  </h3></div>
                                    <div class="card-body">
                                        <div class="leftSide"><!-- Begin of content -->
                                            <form method="post" action="{{route('reference.store')}}">
                                                @csrf


                                            <div class="panel panel-default validation">
                                                
                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Détermination</label>
                                                            <input type="text" id="determination" value="{{old('determination')}}" name="determination" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>Type analyse</label>
                                                        <select class="form-control " id="type" value="{{old('type')}}" name="type">
                                                            <option value="Micro-biologique">Micro-biologique</option>
                                                            <option value="Organo-liptique">Organo-liptique</option>
                                                            <option value="Physico-chimique">Physico-chimique</option>
                                                        </select>
                                                    </div>

                                                    <!-- <div class="col-md-4">
                                                        <label>Produit</label>
                                                        <select class="form-control produits"  value="{{old('produit')}}" name="produit">
                                                            @foreach($produits as $produit)
                                                                <option value="{{$produit->id}}">{{$produit->designation}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div> -->

                                                    <!-- <div class="col-md-4">
                                                        <label>Paramètre</label>
                                                        <select class="form-control settings" id="type" value="{{old('setting')}}" name="setting">
                                                        @foreach($settings as $setting)
                                                                <option value="{{$setting->id}}">{{$setting->determination}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div> -->


                                                </div>
                                            </div>
                                            
                                        
                                            <div class="well">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Methode</label>
                                                            <input type="text" id="methode" value="{{old('methode')}}" name="methode" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Norme m</label>
                                                            <input type="text" id="pm" value="{{old('norme_m')}}" name="norme_m" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Norme M</label>
                                                            <input type="text" id="gm" value="{{old('norme_mm')}}" name="norme_mm" class="form-control">
                                                        </div>
                                                    </div>	
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p></p>
                                                    <button type="submit" id="valider" class="btn btn-info btn-block">Valider</button>
                                                </div>
                                            </div>


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
    $('.produits').select2();
    $('.settings').select2();
});

</script>
@endsection