@extends('layouts.master')

@section('content')


<div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a  class="btn btn-info" href="{{route('client.create')}}"><i class="fa fa-plus"></i> Ajouter</a>
                                    <a class="btn btn-danger" href="" id="hrefDelete">Supprimer la séléction </a>

                                </h4>
                                
                                <div class="table-responsive">
                                    <table id="zero_config" id="DataTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Nom</th>
                                                <th>Wilaya</th>
                                                <th>Téléphone</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($clients as $client)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" value="{{$client->id}}" class="form-check-input all analyse-checkbox" id="exampleCheck{{$client->id }}">
                                                    {{$client->id }}
                                                </td>
                                                <td>{{$client->raison_sociale ?? $client->nom}}</td>
                                                <td>{{$client->getWilaya() }}</td>                                                
                                                <td>{{$client->telephone }}</td>                                                
                                                <td>
                                                <a class="btn btn-info text-white" href="{{route('client.edit',['client'=>$client->id])}}"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('client.destroy',['client'=>$client->id])}}" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a>

                                                <!-- <input type="checkbox" class="state" id="{{$client->id}}" @if($client->etat == 1) checked @endif 
                                                data-toggle="toggle" data-size="mini"> -->

                                                </td>
                                            </tr>

                                            @endforeach                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


@endsection

@section('scripts')
<script>

$(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $('.state').on('change',function(e){
            var id = this.id
            console.log(id)

            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '/client/state/'+id,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data)
                    toastr.success('état changé');
                },
                error: function(err) { 
                    console.log(err)
                    toastr.error(err)
                }
            });
        })


    $('.analyse-checkbox').change(function(){
        console.log('test')
        var checks = $(".analyse-checkbox:checked"); // returns object of checkeds.
        console.log(checks)
        var hrefDelete = "/client/supprimer/list?id=";
        for(var i=0; i<checks.length; i++){
            hrefDelete =hrefDelete +$(checks[i]).val()+",";
            $('#hrefDelete').attr('href',hrefDelete)
        }
    });

});

</script>
@endsection