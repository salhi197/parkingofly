@extends('layouts.master')

@section('page_wrapper')
@endsection

@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouveau stock  </h3></div>
                                    <div class="card-body">
                                        <div class="leftSide"><!-- Begin of content -->
                                        <form  action="{{route('stock.update',['stock'=>$stock->id])}}" method="post">
                                            @csrf
                                            <div class="container-fluid">
                                                    <div class="well sm">
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                <label for="">Produit :</label>
                                                                    <select class="form-control " id="" value="{{$stock->produit}}" name="produit">
                                                                        <option value="">séléctionner produit</option>

                                                                        @foreach($produits as $produit)
                                                                            <option value="{{$produit->id}}"
                                                                            <?php if($stock->produit == $produit->id) { ?> selected <?php } ?> 
                                                                            >{{$produit->designation}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="">Code barre</label>
                                                                    <input type="text" class="form-control" id="code_barre" value="{{old('code_barre')}}" name="code_barre">
                                                                </div>
                                                            </div>  -->
                                                        </div>
                                                    </div>
                                                    <!-- <div class="well autres hidden">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">Autres Produits :</label>
                                                                    <input type="text" value="{{old('nomproduit')}}" name="nomproduit" id="produit" value="" autocomplete="off" placeholder="tapez une famille" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="well">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="">fournisseur</label>
                                                                    <input type="text" class="form-control" id="fournisseur" value="{{$stock->fournisseur}}" name="fournisseur">
                                                                </div>
                                                            </div> 
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="">Quantité</label>
                                                                    <input type="text" class="form-control" id="quantite" value="{{$stock->quantite}}" name="quantite">
                                                                </div>
                                                            </div> 
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label> prix d'achat</label>
                                                                    <input type="text" value="{{$stock->prix}}" name="prix" id="prix" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="well">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>Date :</label>
                                                                    <input type="date" value="{{$stock->date_stock}}" name="date_stock" id="date_stock" class="form-control mesdates">
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