@extends('layouts.master')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">
                            Historiaue Des Payments
                        </h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Accueil</a></li>
							<li class="breadcrumb-item active" aria-current="page">payment</li>
						</ol>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
                                    <div class="col-md-12 col-lg-12">
                                    <form class="row" method="post" action="{{route('payment.filter')}}" id="formfilter">
                                            @csrf
                                            <div class="col-md-2">
                                                <input class="form-control" placeholder="YYYY/MM/DD" value="{{$debut_entre ?? ''}}" name="debut_entre" type="date">
                                            </div>

                                            <div class="col-md-2">
                                                <input class="form-control" placeholder="YYYY/MM/DD" value="{{$fin_entre ?? ''}}" name="fin_entre" type="date">
                                            </div>
 
                                            <div class="col-md-2">
                                                <button class="btn btn-primary" type="buton" id="filter">
                                                    <i class="fa fa-filter"></i> Filtrer 
                                                </button>
                                            </div>
                                        </form>

                                    </div> 
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="datatable-2" class="table table-bordered key-buttons text-nowrap" >
											<thead>
												<tr>
													<th class="border-bottom-0">ID </th>
													<th class="border-bottom-0">Montant</th>
													<th class="border-bottom-0">type</th>
                                                    <th class="border-bottom-0">Remarque</th>                                                    
													<th class="border-bottom-0">Date Paiment</th>
													<th class="border-bottom-0">Crée le</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach($payments as $payment)
												<tr>
													<td>{{$payment->id ?? ''}}</td>
													<td>
                                                        <span class="badge badge-success">{{$payment->montant ?? ''}} DA</span>                                                    
                                                    </td>
													<td>
                                                        <span class="badge badge-info">{{$payment->type ?? ''}}</span>
                                                    </td>

													<td>
                                                        {{$payment->remarque ?? ''}}
                                                    </td>

                                                    <td>{{$payment->date_payment ?? ''}}</td>
                                                    <td>{{$payment->created_at ?? ''}}</td>

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
