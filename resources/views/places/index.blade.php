@extends('layouts.master')

@section('page_wrapper')
@endsection


@section('content')

<div class="container-fluid">

                        <h1 class="mt-4"> Place</h1>
                            <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary right" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-plus"></i> Ajouter place
                                </button>
                            </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class=" text-primary">
                                                <tr>
                                                    <th>ID place</th>
                                                    <th>Numéro</th>
                                                    <th>Etat</th>
                                                    
                                                    <th>actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($places as $place)
                                        <tr>
                                            <td>{{$place->id ?? ''}}</td>
                                            <td>{{$place->numero ?? 'saz'}}</td>
                                            <td>
                                                @if($place->disponible == 1)
                                                Disponible
                                                @else
                                                Non Disponible
                                                @endif
                                            </td>
                                            <td>
                                                <div class="table-action">  
                                                    <a  href="{{route('place.destroy',['place'=>$place->id])}}"
                                                        onclick="return confirm('etes vous sure  ?')"
                                                        class="btn btn-danger text-white"><i class="fa fa-trash"></i> &nbsp;
                                                    </a>
                                                    <button type="button" class="btn btn-primary right" data-toggle="modal" data-target="#exampleModal{{$place->id}}">
                                                        <i class="fa fa-edit"></i> 
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="exampleModal{{$place->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter place</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                
                                                <div class="modal-body">
                                                    <form id="placeFform" action="{{route('place.update',['place'=>$place->id])}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                        <div class="form-group">
                                                            <label class="small mb-1" for="inputFirstName">Emplacement : </label>
                                                            <input type="text" name="place" value="{{$place->label}}"  class="form-control"/>
                                                        </div>    
                                                        <button class="btn btn-primary btn-block" type="submit" id="ajax_place">Envoyer</button>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                        </div>




                                        @endforeach
                                        </tbody>



                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter place</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      

      <div class="modal-body">
            <form id="placeFform" action="{{route('place.create')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label class="small mb-1" for="inputFirstName">Label: </label>
                    <input type="text" name="label"  class="form-control"/>
                </div>    

                <div class="form-group">
                    <label class="small mb-1" for="inputFirstName">Numéro place: </label>
                    <input type="text" name="numero"  class="form-control"/>
                </div>    


                <button class="btn btn-primary btn-block" type="submit" id="ajax_place">ajouter place</button>





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

		    $('#placeFform').on('submit', function(event){
	        	var values = {};
				$.each($('#placeFform').serializeArray(), function(i, field) {
				    values[field.name] = field.value;
				});
				console.log(values)
        	})
        });



</script>
@endsection
