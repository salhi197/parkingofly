@extends('layouts.master')





@section('styles')

<link href="{{asset('css/ticket.css')}}" rel="stylesheet">

<style></style>

@endsection

@section('content')



                                <div class="container-fluid">

                                    <div class="card mb-4">

                                        <div class="card-header">

                                            <form method="post" action="/reservation/caisse/filter" >                                                    

                                                @csrf

                                                <div class="row">

                                                    <div class="col-md-2" >

                                                        <label class="control-label">{{ __('Début') }}: </label>

                                                        <input class="form-control" value="{{$date_debut ?? ''}}" name="date_debut" type="date" />

                                                    </div>



                                                    <div class="col-md-2" >

                                                        <label class="control-label">{{ __('Fin') }}: </label>

                                                        <input class="form-control" value="{{$date_fin ?? ''}}" name="date_fin" type="date" />

                                                    </div>



                                                   <div class="col-md-2" style="padding:35px;">

                                                        <button type="submit" class="row btn btn-primary" >

                                                            Filtrer

                                                        </button>                                                                                                        

                                                    </div>

                                                </div>

                                            </form>

                                        </div>



                                        <div class="card-group">

                                            <div class="card border-right">

                                                <div class="card-body">

                                                    <div class="d-flex d-lg-flex d-md-block align-items-center">

                                                        <div>

                                                            <div class="d-inline-flex align-items-center">

                                                                <h2 class="text-dark mb-1 font-weight-medium">{{$total ?? ''}} DA</h2>

                                                            </div>

                                                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total revenue </h6>

                                                        </div>

                                                        <div class="ml-auto mt-md-3 mt-lg-0">

                                                            <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="card border-right">

                                                <div class="card-body">

                                                    <div class="d-flex d-lg-flex d-md-block align-items-center">

                                                        <div>

                                                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup

                                                                    class="set-doller">DA</sup>{{$totalToday ?? ''}}</h2>

                                                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Revenue Aujourd'hui

                                                            </h6>

                                                        </div>

                                                        <div class="ml-auto mt-md-3 mt-lg-0">

                                                            <span class="opacity-7 text-muted"></span>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>



                                            <div class="card">

                                                <div class="card-body">

                                                    <div class="d-flex d-lg-flex d-md-block align-items-center">

                                                        <div>

                                                            <h2 class="text-dark mb-1 font-weight-medium">{{$filtered}}</h2>

                                                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Filtré</h6>

                                                        </div>

                                                        <div class="ml-auto mt-md-3 mt-lg-0">

                                                            <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>                                                                                







 



                            <div class="card-body">

                                <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                        <thead>

                                            <tr>

                                                <th>Id</th>

                                                <th>Nom Complet</th>

                                                <th>Type de Paiment</th>

                                                <th>Réçu de paiment</th>

                                                

                                                <th>Motant</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @foreach($paiments as $paiment)                                            

                                            <tr>

                                                <td> 

                                                    <span class="badge badge-success">

                                                        {{$paiment->id ?? ''}}

                                                    </span>

                                                </td>

                                                <td> {{$paiment->getReservation()['nom'] }} {{$paiment->getReservation()['prenom'] }}  </td>

                                                <td> {{$paiment->type }} </td>

                                                <td> {{$paiment->recu ?? ''  }} </td>

                                                <td> {{$paiment->montant }} </td>                                                

                                            </tr>

                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

            @endsection

            

@section('scripts')

<script>

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

            $('.regler').on('click', function(event){

                var id = this.id;

                $('#formregler').attr('action','/traduction/regler/'+id)

            })





        });

        

        /**

         * 

         */

</script>



@endsection