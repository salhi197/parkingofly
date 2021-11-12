@extends('layouts.master')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">
                            Tables recettes
                        </h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Accueil</a></li>
							<li class="breadcrumb-item active" aria-current="page">recettes</li>
						</ol>
					</div>
                    
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-plus"></i> Ajouter 
                                    </button>
								</div>

								<div class="card-body">
                                    <form method="post" action="{{route('recette.filter')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Date Début</label>
                                                    <input type="date" name="date_debut" value="{{$date_debut ?? ''}}" class="form-control">
                                                </div>                                     
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Date Fin</label>
                                                    <input type="date" name="date_fin" value="{{$date_fin ?? ''}}" class="form-control">
                                                </div>                                     
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Désignation</label>
                                                    <select class='form-control stocks' name='_designation' id="_designation" >
                                                        <option value="" >Désignation</option>                    
                                                        @foreach($_designations as $_designation)
                                                        <option value="{{$_designation}}">
                                                            {{$_designation}}
                                                        </option>
                                                        @endforeach 
                                                    </select>
                                                </div>                                     
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Client</label>
                                                    <select class='form-control stocks' name='_designation' id="_designation" >
                                                        <option value="" >Client</option>                    
                                                        @foreach($clients as $client)
                                                        <option value="{{$client->id}}">
                                                            {{$client->nom ?? $client->raison_sociale}}
                                                        </option>
                                                        @endforeach 
                                                    </select>
                                                </div>                                     
                                            </div>


                                            <div class="col-sm-2">
                                                <label>&nbsp;</label>
                                                <button type="submit" id="valider" class="btn btn-info btn-block">filter</button>
                                            </div>
                                        </div>
                                    </form>
									<div class="table-responsive">
										<table id="datatable-5" class="table table-bordered  text-nowrap" >
											<thead>
												<tr>
                                                    <th class="border-bottom-0">Id</th>
                                                    <th class="border-bottom-0">Client</th>

                                                    <th class="border-bottom-0">date_recette</th>
                                                    <th class="border-bottom-0">designation</th>
                                                    <th class="border-bottom-0">montant</th>
                                                    <th class="border-bottom-0">actions</th>

                                                
												</tr>
											</thead>
											<tbody>
                                            @foreach($recettes as $key=>$recette)
												<tr>
                                                    <?php $index = $key+1; ?>

                                                    <td>{{$index ?? '' }}</td>
                                                    <td>{{$recette->getClient()['nom'] ?? $recette->getClient()['raison_sociale'] }}</td>

                                                    <td>
                                                    {{ Carbon\Carbon::parse($recette->date_recette)->format('Y-m-d') }}
                                                    </td>
                                                    <td>{{$recette->designation ?? '' }}</td>
                                                    <td>{{$recette->montant ?? '' }} DA</td>
                                                    <td>
                                                        <a class="btn btn-danger" href="{{route('recette.destroy',['recette'=>$recette->id])}}" 
                                                        onclick="return confirm('Are you sure?')"
                                                        >
                                                                <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
												</tr>
                                            @endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
@endsection

@section('modals')

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une Recette</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('recette.create')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" class="form-control" 
                                                            name="facture"
                                                            value="{{$facture->id ?? ''}}" >

                                                        <div class="form-group">
                                                            <label class="form-label">Montant :  </label>
                                                            <input type="number" class="form-control" 
                                                            name="montant"
                                                            placeholder="Montant e.g : 230.000,00 DA" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Date de Recette :  </label>
                                                            <input type="date" class="form-control" 
                                                            name="date_recette"
                                                            placeholder="" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Client</label>
                                                            <select class='form-control stocks' name='_designation' id="_designation" >
                                                                <option value="" >Désignation</option>                    
                                                                @foreach($clients as $client)
                                                                <option value="{{$client->id}}">
                                                                    {{$client->raison_sociale}}
                                                                </option>
                                                                @endforeach 
                                                            </select>
                                                        </div>                                     


                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>

                                                    </form>

                                                </div>
                                                </div>
                                            </div>
                                        </div>





@endsection
@section('styles')
<!-- TIME PICKER CSS -->
<link href="{{asset('assets/plugins/time-picker/jquery.timepicker.css')}}" rel="stylesheet"/>
<!-- DATE PICKER CSS -->
<link href="{{asset('assets/plugins/date-picker/spectrum.css')}}" rel="stylesheet"/>


@endsection

@section('scripts')
<script src="{{asset('assets/plugins/time-picker/jquery.timepicker.js')}}"></script>
<script src="{{asset('assets/plugins/time-picker/toggles.min.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/spectrum.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>
<script src="{{asset('assets/plugins/input-mask/jquery.maskedinput.js')}}"></script>
<script>
$(document).ready(function() {
    $( "#generate" ).on('click',function(e){
        e.preventDefault()
        console.log('te')
        $('#formgenerate').submit();//('test');
    });

    $( "#filter" ).on('click',function(e){
        e.preventDefault()
        $('#formfilter').submit();//('test');
    });


});
</script>
@endsection
