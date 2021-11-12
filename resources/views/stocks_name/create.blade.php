@extends('layouts.master')

@section('page_wrapper')
@endsection

@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouveau   </h3></div>
                                    <div class="card-body">
                                        <div class="leftSide"><!-- Begin of content -->
                                            <form action="{{route('product.store')}}" method="post">
                                            @csrf
                                            <div class="container-fluid">
                                                    <div class="well sm">
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                <label for="">Produit :</label>
                                                                <input type="text" class="form-control" id="product" value="{{old('name')}}" name="name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="well">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="">fournisseur</label>
                                                                    <input type="text" class="form-control" id="fournisseur" value="{{old('fournisseur')}}" name="fournisseur">
                                                                </div>
                                                            </div> 
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="">Quantité</label>
                                                                    <input type="number" class="form-control" id="quantite" value="{{old('quantite')}}" name="quantite">
                                                                </div>
                                                            </div> 
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label> prix d'achat</label>
                                                                    <input type="text" value="{{old('prix')}}" name="prix" id="prix" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="well">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>Date fabrication:</label>
                                                                    <input type="date" value="{{old('date_fabrication')}}" name="date_fabrication" id="date_fabrication" class="form-control mesdates">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>Date Prémption:</label>
                                                                    <input type="date" value="{{old('date_premption')}}" name="date_premption" id="date_premption" class="form-control mesdates">
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>Seuil:</label>
                                                                    <input type="number" value="{{old('seuil')}}" name="seuil" id="seuil" class="form-control mesdates">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>N lot:</label>
                                                                    <input type="number" value="{{old('lot')}}" name="lot" id="lot" class="form-control mesdates">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="well">
                                                        <div class="row">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <p></p>
                                                                    <button type="submit" id="valider" class="btn btn-info btn-block">Valider</button>
                                                                </div>
                                                            </div>

                                                        </div>
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