@extends('layouts.master')

@section('page_wrapper')
    @include('includes.categories')
@endsection


@section('content')


<div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a class="btn btn-info" href="{{route('produit.create')}}">
                                        <i class="fa fa-plus"></i>
                                         Ajouter produit 
                                    </a>
                                    <a class="btn btn-danger" href="" id="hrefDelete">Supprimer la séléction </a>

                                </h4>
                                
                                
                                <div class="table-responsive">
                                    <table id="zero_config" id="DataTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Produit</th>
                                                <th>Famille</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($produits as $produit)
                                            <tr>
                                                <td>
                                                <input type="checkbox" value="{{$produit->id}}" class="form-check-input all produit-checkbox" id="exampleCheck{{$produit->wilaya }}">

                                                {{$produit->id ?? ''}}</td>
                                                <td>{{$produit->designation}}</td>
                                                <td>{{$produit->getCategorie()['label'] ?? ''}}</td>
                                                <!-- <td>
                                                    foreach(produit->getReferences() as reference)
                                                        reference}}
                                                    endforeach
                                                </td>

                                                <td>
                                                    foreach(produit->getUnites() as unite)
                                                        unite}}
                                                    endforeach
                                                </td> -->


                                                


                                                <td>
                                                <a class="btn btn-info text-white" href="{{route('produit.edit',['produit'=>$produit->id])}}"><i class="fa fa-edit"></i></a>
                                                <a href="#" onclick="alert('Vous ne pouvez pas supprimer ce produit')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a>
                                                </td>
                                            </tr>

                                            @endforeach                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter organo : </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                        <form id="organoFform" action="{{route('organo.create')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputFirstName">organo: </label>
                                                <select class="form-control "  value="{{old('client')}}" name="type">
                                                    <option value="">séléctionner le type</option>
                                                    <option value="1" >Aspect & couleur</option>
                                                    <option value="2" >Gout & Odeur</option>
                                                    <option value="3" >Examen Macroscopique</option>
                                                </select>

                                            </div>    

                                            <div class="form-group">
                                                <label class="small mb-1" for="inputFirstName">Valeur: </label>
                                                <input type="value" name="value"  class="form-control"/>
                                            </div>    
                                            <button class="btn btn-primary btn-block" type="submit" id="ajax_organo">ajouter organo</button>
                                        </form>
                                </div>
                                </div>
                            </div>
                        </div>



@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 0, "asc" ]]
    } );
} );

$(document).ready(function() {
    $('.produit-checkbox').change(function(){
        console.log('test')
        var checks = $(".produit-checkbox:checked"); // returns object of checkeds.
        console.log(checks)
        var hrefDelete = "/produit/supprimer/list?id=";
        for(var i=0; i<checks.length; i++){
            hrefDelete =hrefDelete +$(checks[i]).val()+",";
            $('#hrefDelete').attr('href',hrefDelete)
        }
    });
})

</script>


@endsection
