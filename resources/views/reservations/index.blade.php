@extends('layouts.master')


@section('styles')
<link href="{{asset('css/ticket.css')}}" rel="stylesheet">
<style>

.full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }


</style>
@endsection
@section('content')

                    <div class="container-fluid">
                       <div class="card mb-4">

                            <div class="card-header">
                                            <form method="post" action="{{route('reservation.filter')}}" >                                                    
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
                                                    <div class="col-md-2" >
                                                        <label class="control-label">Hotel: </label>
                                                        <select name="hotel" class="form-control">
                                                            <option value="1">Hotel Hyat Regency</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-2" >
                                                        <label class="control-label">Etat: </label>
                                                        <select name="etat" class="form-control">
                                                            <option value="en attente">en cours</option>
                                                            <option value="en attente de paiement">en attente de paiement</option>
                                                            <option value="confirmer">Confirmé</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-2" style="padding:35px;">
                                                        <button type="submit" class="row btn btn-primary" >
                                                            Filtrer
                                                        </button>                                                                                                        
                                                    </div>
                                        </form>

                                                </div>
                            </div>

 

                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Etat</th>
                                                <th>Nom Complet</th>
                                                <th>Téléphone</th>
                                                <th>Email</th>
                                                <th>N Place</th>
                                                <th>Date & heure</th>
                                                <th>Montant</th>                                                
                                                <th>actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reservations as $reservation)                                            
                                            <tr>
                                                <td> 
                                                    <span class="badge badge-success">
                                                        {{$reservation->etat ?? "En Cours"}}
                                                    </span>
                                                </td>
                                                <td> {{$reservation->nom }} {{$reservation->prenom }}  </td>
                                                <td> {{$reservation->telephone }} </td>
                                                <td> {{$reservation->email }} </td>
                                                <td> {{$reservation->place }}  </td>
                                                <td> {{$reservation->debut }} // {{$reservation->fin }}  </td>
                                                <td>
                                                    <span class="badge badge-info">
                                                    {{$reservation->montant() }} DA
                                                    </span> 
                                                </td>
                                                <td >
                                                    <div class="table-action">  
                                                        <div class="dropdown">

                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$reservation->id ?? ''}}">
                                                                Ticket
                                                            </button>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#payment{{$reservation->id ?? ''}}">
                                                                Payment
                                                            </button>
                                                            <div class="modal fade" id="exampleModal{{$reservation->id ?? ''}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$reservation->id ?? ''}}Label" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Ticket</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                    
                                                                        <table class="col-md-12">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="h6"><strong>Nom et Prénom</strong></td>
                                                                                    <td class="h5"></td>
                                                                                </tr>
                                                                                
                                                                                <tr>
                                                                                    <td class="h6"><strong>Date et Heure D'entrée</strong></td>
                                                                                    <td class="h5"></td>
                                                                                </tr>
                                                                                
                                                                                <tr>
                                                                                    <td class="h6"><strong>Date et Heure de Sortie</strong></td>
                                                                                    <td class="h5"></td>
                                                                                </tr>
                                                                                
                                                                                <tr>
                                                                                    <td class="h6"><strong>Téléphone</strong></td>
                                                                                    <td class="h5">0230316</td>
                                                                                </tr>
                                                                                
                                                                                <tr>
                                                                                    <td class="h6"><strong>Email</strong></td>
                                                                                    <td class="h5">032165</td>
                                                                                </tr>
                                                                                
                                                                                <tr>
                                                                                    <td class="h6"><strong>Place </strong></td>
                                                                                    <td class="h5">0321649843</td>
                                                                                </tr>  

                                                                                <tr>
                                                                                    <td class="h6"><strong>Plaque d'immatriculation</strong></td>
                                                                                    <td class="h5">456789098765</td>
                                                                                </tr>                            

                                                                                <tr>
                                                                                    <td class="h6"><strong>Marque</strong></td>
                                                                                    <td class="h5">50</td>
                                                                                </tr>
 
                                                                            </tbody>
                                                                        </table>
                                                                                
                                                                        <div class="row">
                                                                            <div class="col-md-12"> 
                                                                                <!-- <img src="/storage/app/public/qrcodes/1636877747.svg" alt="teste" class="img-thumbnail">   -->
                                                                            </div>                                                                        
                                                                        </div>
                                                                    </div>


                                                                    <div class="modal-footer">
                                                                        <a class="btn btn-primary" target="_blink" href="{{route('reservation.ticket',['reservation'=>$reservation->id])}}">
                                                                            Ticket
                                                                        </a>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <a href="{{route('reservation.valider',['reservation'=>$reservation->id])}}" class="btn btn-primary">Valider</a>
                                                                        <a href="{{route('reservation.destroy',['reservation'=>$reservation->id])}}"  onclick="return confirm('Etes vous sur ?')"  class="btn btn-danger" >Annuler</a>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            </div> 

                                                            @if($reservation->state = "en attente paiment")
                                                                @include('includes.payment',['reservation'=>$reservation])
                                                            @endif

                                                        </div>
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