@extends('layouts.master')



@section('content')

<div class="container-fluid">

                        <h1 class="mt-4">Historique Stock</h1>
                             <div class="card mb-4">
                                     <div class="card-header">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label> Filtrer par Fournisseur</label>
                                                        <select class='form-control stocks' name='product' id="product" >
                                                            <option value="all" >tous les Produits</option>                    
                                                            @foreach($products as $product)
                                                            <option value="{{$product->id}}">
                                                            
                                                                {{$product->name}} | quantite : {{$product->quantite}}
                                                            </option>
                                                            @endforeach 
                                                        </select>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <label> Type</label>
                                                        <select class='form-control types' name='product' id="product" >
                                                            <option value="all_types" >tous les types</option>                    
                                                            <option value="1">Physicochimie</option>
                                                            <option value="2">Microbiologie</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1" style="padding:35px;">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                            entré
                                                        </button>                                                                                                        
                                                    </div>
                                                    <div class="col-md-1" style="padding:35px;">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#example">
                                                            sortie
                                                        </button>
                                                    </div>
                                                    <div class="col-md-3" style="padding:35px;">
                                                        <a class="btn btn-primary" href="{{route('product.create')}}">
                                                            Ajouter Produit
                                                        </a>
                                                    </div>
                                                    <div class="col-md-3" style="padding:35px;">
                                                        <a class="btn btn-primary" href="{{route('categorie2.index')}}">
                                                            Categories 
                                                        </a>
                                                    </div>
                                                    
                                                    <div class="col-md-3" style="padding:35px;">
                                                        <a class="btn btn-primary" href="{{route('product.index')}}">
                                                            Liste Des Produits
                                                        </a>
                                                    </div>



                                                </div>
                                </div>


                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-bordered" id="dataTable3" width="100%" cellspacing="0">

                                        <thead>

                                            <tr>
                                                <th>ID </th>
                                                <th>product </th>
                                                <th>Quantite</th>
                                                <th>type Opération</th>
                                                <th>type Produit</th>
                                                <th>date</th>    
                                                <th>Action</th>    
                                            </tr>

                                        </thead>

                                        <tbody>
                                            @foreach($stocks as $stock)                                            

                                            <?php
                                                    $product= json_decode($stock->product); 
                                                ?>

                                            <tr class="product                                             
                                                @if($stock->operation == 'sortie')
                                                    sortie
                                                @else
                                                    entree
                                                @endif    
                                            "
                                             style="color:@if($stock->operation == "sortie") red @else green @endif">

                                                    <td>{{$stock->id ?? ''}}</td>

                                                    <td>{{$product->name ?? ''}} </td>
                                                <td>{{$stock->quantite ?? ''}} </td>
                                                <td>
                                                @if($stock->operation == 'sortie')
                                                <span class="badge badge-danger">{{$stock->operation}}</span>
                                                @else
                                                <span class="badge badge-success">{{$stock->operation}}</span>
                                                @endif

                                                 </td>

                                                 <td>
                                                    @if($stock->getProduct()['type'] == 1)
                                                    <span class="badge badge-danger">
                                                        Physicochimie
                                                    </span>
                                                    @else
                                                    <span class="badge badge-success">
                                                    Microbiologie
                                                    </span>
                                                    @endif

                                                </td>


                                                 <td> {{$stock->created_at ?? '' }} </td>
                                                    <td>
                                                        <div class="table-action">  

                                                            <!-- <a 
                                                            href="{{route('stock.delete',['id_stock'=>$stock->id])}}"
                                                            class="btn btn-danger">
                                                                <i class="fas fa-trash"></i> 
                                                            </a> -->

                                                        </div>
                                                    </td>

                                            </tr>

           

                                            @endforeach





                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fenetre Entrer : </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('stock.entrer')}}" method="post">
            @csrf


            <div class="form-group items" id="dynamic_form">
                <div class="row">
                    <div class="button-group" style="padding: 27px;">
                        <a href="javascript:void(0)" class="btn btn-primary" id="plus5"><i class="fa fa-plus"></i></a>
                        <a href="javascript:void(0)" class="btn btn-danger" id="minus5"><i class="fa fa-minus"></i></a>
                    </div>

                    <div class="col-md-4">
                        <label class="small mb-1" for="inputFirstName">product: </label>
                        <select class='form-control products' name='product' id="product" >
                            <option value=""></option>
                            @foreach($products as $product)
                            <option class="product" value="{{$product}}">
                                {{$product->name}} | quantite : {{$product->quantite}}
                            </option>
                            @endforeach 
                        </select>   
                    </div>
                    <div class="col-md-4">
                        <label class="small mb-1" for="inputEmailAddress">Quantité : </label>
                        <input type="number" class="form-control quantites" name="quantite" id="quantite" placeholder="Entere Quantité product : ">
                    </div>
                    <div class="col-md-4">
                        <label class="small mb-1" for="inputEmailAddress">Date : </label>
                        <input type="date" class="form-control " name="date" id="date" placeholder="Date : ";>
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-primary">envoyer</button>

        </form>


      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="example" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fentre Sortie : </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('stock.sortie')}}" method="post">
        @csrf
            <div class="form-group items" id="dynamic_form_sortie">
                <div class="row">
                    <div class="button-group" style="padding: 27px;">
                        <a href="javascript:void(0)" class="btn btn-primary" id="plus5_sortie"><i class="fa fa-plus"></i></a>
                        <a href="javascript:void(0)" class="btn btn-danger" id="minus5_sortie"><i class="fa fa-minus"></i></a>
                    </div>

                    <div class="col-md-4">
                        <label class="small mb-1" for="inputFirstName">product: </label>
                        <select class='form-control products' name='product' id="product" >
                            <option value=""></option>
                            @foreach($products as $product)
                            <option class="product" value="{{$product}}">
                                {{$product->name}} | quantite : {{$product->quantite}}
                            </option>
                            @endforeach 
                        </select>   
                    </div>
                    <div class="col-md-4">
                        <label class="small mb-1" for="inputEmailAddress">Quantité : </label>
                        <input type="number" class="form-control quantites" name="quantite" id="quantite" placeholder="Entere Quantité product ";>
                    </div>
                    <div class="col-md-4">
                        <label class="small mb-1" for="inputEmailAddress">Date : </label>
                        <input type="date" class="form-control " name="date2" id="date" placeholder="Date : ";>
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-primary">envoyer</button>

        </form>
      </div>
    </div>
  </div>
</div>





@endsection


@section('scripts')
    <script>

        $(document).ready(function() {
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

		    $('#Commandeform').on('submit', function(event){
	        	var values = {};
				$.each($('#Commandeform').serializeArray(), function(i, field) {
				    values[field.name] = field.value;
				});
				console.log(values)
        	})
            /**
             * 
             */
        	var dynamic_form_sortie =  $("#dynamic_form_sortie").dynamicForm("#dynamic_form_sortie","#plus5_sortie", "#minus5_sortie", {
		        limit:10,
		        formPrefix : "dynamic_form_sortie",
		        normalizeFullForm : false
		    });


		    $("#dynamic_form_sortie #minus5").on('click', function(){

		    	var initDynamicId = $(this).closest('#dynamic_form_sortie').parent().find("[id^='dynamic_form_sortie']").length;

		    	if (initDynamicId === 2) {
		    		$(this).closest('#dynamic_form_sortie').next().find('#minus5').hide();
		    	}
		    	$(this).closest('#dynamic_form_sortie').remove();
		    });

		    $('#Commandeform').on('submit', function(event){
	        	var values = {};
				$.each($('#Commandeform').serializeArray(), function(i, field) {
				    values[field.name] = field.value;
				});
				console.log(values)
        	})



        });


    function onChangestock()
    {
        $('.stocks').on('change', function (e) {
                var valueSelected = this.value;
                console.log(valueSelected)
                if (valueSelected=="all") {
                    $('.product').show()
                    
                }else{
                    $('.product').hide()
                    $('.product-'+valueSelected).show()
                }                
        });
    }
    function onType()
    {
        $('.types').on('change', function (e) { 
                var valueSelected = this.value;
                console.log(valueSelected)
                if (valueSelected=="all_types") {
                    $('.sortie').show()
                    $('.entree').show()
                }if(valueSelected=="sortie"){
                    $('.sortie').show()
                    $('.entree').hide()
                }

                if (valueSelected=="entree") {
                    $('.sortie').hide()
                    $('.entree').show()                    
                }                
        });
    }

function onChangeClient()
{
    $('.fournisseurs').on('change', function (e) {
        var valueSelected =$('.fournisseurs option:selected').val();
        var obj = JSON.parse(valueSelected);
        console.log(obj)
        $('.product').hide()
        $('.fournisseur_'+obj.id).show()        
    });
}


function onClient()
    {

        $('.clients').on('change', function (e) {
                var valueSelected = this.value;
                console.log(valueSelected)
                if (valueSelected=="all_clients") {
                    $('.client').show()
                    
                }else{
                    $('.client').hide()
                    $('.client-'+valueSelected).show()
                }                
        });

    }



            $(document).ready(function () {
                onChangestock();
                onType();
                onClient();
                onChangeClient();
            });

    </script>
@endsection
