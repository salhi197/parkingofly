@extends('layouts.master')

@section('page_wrapper')
    @include('includes.settings')
@endsection


@section('content')
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouveau Paramètres  </h3></div>
                                      <div class="card-body">
                                      <form role="form" action="{{route('setting.update',['setting'=>$setting->id])}}" method="post">
                                          @csrf
                                            <div class="well sm">
                                                <div class="row">
                                                    <input type="hidden" name="type" value="{{$setting->type ?? ''}}" class="form-control" required="true">
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>Paremètre</label>
                                                            <input type="text" value="{{$setting->determination ?? ''}}" name="determination" class="form-control" required="true">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>Durée</label>
                                                            <input type="number" value="{{$setting->duree ?? ''}}" name="duree" class="form-control">
                                                        </div> 
                                                    </div>


                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>Norme</label>
                                                            <input type="text" name="norme" id="norme" value="{{$setting->norme ?? ''}}" class="form-control">
                                                        </div> 
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>Prix:</label>
                                                            <input type="text" name="prix" id="prix" value="{{$setting->prix ?? ''}}" class="form-control">
                                                        </div> 
                                                    </div>



                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>Réference:</label>
                                                            <input type="text" name="reference" id="reference" value="{{$setting->reference ?? ''}}" class="form-control">
                                                        </div> 
                                                    </div>


                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>Unité:</label>
                                                            <input type="text" name="unite" id="unite" value="{{$setting->unite ?? ''}}" class="form-control">
                                                        </div> 
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" id="valider" class="btn btn-info btn-block">Valider</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

@endsection
<!-- @section('scripts')
<script>
$(document).ready(function() {
    $('.produits').select2();
    $('.settings').select2();
});
</script>
@endsection
 -->
