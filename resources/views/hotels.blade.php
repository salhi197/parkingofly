@extends('layouts.master')

@section('page_wrapper')
@endsection


@section('content')

<div class="container-fluid">

                        <h1 class="mt-4"> hotel</h1>
                            <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary right" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-plus"></i> Ajouter hotel
                                </button>
                            </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class=" text-primary">
                                                <tr>
                                                    <th>ID hotel</th>
                                                    <th>Nom</th>
                                                    <th>adress</th>
                                                    <th>Numéro</th>
                                                    <th>actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($hotels as $hotel)
                                        <tr>
                                            <td>{{$hotel->id ?? ''}}</td>
                                            <td>{{$hotel->name ?? 'sa'}}</td>
                                            <td>{{$hotel->adress ?? 'sa'}}</td>
                                            <td>{{$hotel->telephone ?? 'sa'}}</td>
                                            <td>
                                                <div class="table-action">  
                                                    <a  href="{{route('hotel.destroy',['hotel'=>$hotel->id])}}"
                                                        onclick="return confirm('etes vous sure  ?')"
                                                        class="btn btn-danger text-white"><i class="fa fa-trash"></i> &nbsp;
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="exampleModal{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter hotel</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                
                                                <div class="modal-body">
                                                    <form id="hotelFform" action="{{route('hotel.update',['hotel'=>$hotel->id])}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                        <div class="form-group">
                                                            <label class="small mb-1" for="inputFirstName">Emhotelment : </label>
                                                            <input type="text" name="hotel" value="{{$hotel->label}}"  class="form-control"/>
                                                        </div>    
                                                        <button class="btn btn-primary btn-block" type="submit" id="ajax_hotel">Envoyer</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Ajouter hotel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      

      <div class="modal-body">
        <form action="{{route('hotel.create')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Login</label>
            <input type="text" value="{{ old('email') }}" name="email" class="form-control" id="exampleInputEmail1" placeholder="Entrer clé de Login ">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">mot de passe : </label>
            <input type="text" value="{{ old('password') }}" name="password" class="form-control" placeholder="  ">
        </div>





        <div class="form-group">
            <label for="exampleInputEmail1">nom  : </label>

            <input type="text" class="form-control"  value="{{ old('name') }}" name="name" id="nom" placeholder="votre nom ">

        </div>

        



        <div class="form-group">

            <label for="exampleInputEmail1">N Téléphone :</label>

            <input type="text" value="{{ old('telephone') }}" name="telephone" class="form-control" id="" placeholder="Enter votre numero de téléphone ">

        </div>





        <div class="form-group">

            <label for="exampleInputEmail1">Adress : </label>

            <input type="text" value="{{ old('adress') }}" name="adress" class="form-control" id="adress" placeholder="Enter votre adress : ">

        </div>

                    <div class="form-group">
                    <label class="control-label">{{ __('Commune') }}: </label>
                    <select class="form-control" name="commune_id" id="commune_select">
                        <option value="">{{ __('Please choose...') }}</option>
                        @foreach ($communes as $commune)
                            <option value="{{$commune->id}}" {{$commune->id == (old('commune_id') ?? ($member->commune_id ?? '')) ? 'selected' : ''}}>
                                {{$commune->name}}
                            </option>
                        @endforeach
                    </select>
                    <input class="form-control valid" id="commune_select_loading" value="{{ __('Loading...') }}"
                        readonly style="display: none;"/>
                    @if ($errors->has('commune_id'))
                        <p class="help-block">{{ $errors->first('commune_id') }}</p>
                    @endif
            </div>
            <div class="btn-group" role="group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <button type="button" class="btn btn-danger" data-dismiss="modal"  role="button">Fermer</button>
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

		    $('#hotelFform').on('submit', function(event){
	        	var values = {};
				$.each($('#hotelFform').serializeArray(), function(i, field) {
				    values[field.name] = field.value;
				});
				console.log(values)
        	})
        });


        function watchWilayaChanges() {

            $('#wilaya_select').on('change', function (e) {

                e.preventDefault();

                var $communes = $('#commune_select');

                var $communesLoader = $('#commune_select_loading');

                var $iconLoader = $communes.parents('.input-group').find('.loader-spinner');

                var $iconDefault = $communes.parents('.input-group').find('.material-icons');

                $communes.hide().prop('disabled', 'disabled').find('option').not(':first').remove();

                $communesLoader.show();

                $iconDefault.hide();

                $iconLoader.show();

                $.ajax({

                    dataType: "json",

                    method: "GET",

                    url: "/api/static/communes/ " + $(this).val()

                })

                    .done(function (response) {

                        $.each(response, function (key, commune) {

                            $communes.append($('<option>', {value: commune.id}).text(commune.name));

                        });

                        $communes.prop('disabled', '').show();

                        $communesLoader.hide();

                        $iconLoader.hide();

                        $iconDefault.show();

                    });

            });

        }



        $(document).ready(function () {

            watchWilayaChanges();

        });


</script>
@endsection
