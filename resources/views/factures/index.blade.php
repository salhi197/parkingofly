@extends('layouts.master')

@section('page_wrapper')
@endsection

@section('content')


<div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{route('facture.group')}}" 
                                    class="btn btn-info"
                                    ><i class="fa fa-plus"></i> Ajouter facture</a>
                                    <a class="btn btn-danger" href="" id="hrefDelete">Supprimer la séléction </a>
                                    
                                </h4>
                                
                                <div class="table-responsive">
                                    <table id="zero_config" id="DataTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>numéro</th>
                                                <th>client</th>
                                                <th>Total TTC</th>
                                                <th>Reste </th>
                                                <th>etat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($factures as $facture)
                                            <tr>
                                                <td>{{$facture->numero }}</td>
                                                <td>{{$facture->getClient()['nom']}}</td>
                                                <td>{{$facture->ttc ?? ''}}</td>
                                                <td>{{$facture->reste ?? ''}}</td>                                                

                                                <td>
                                                    @if($facture->reste == 0)
                                                    <span class="badge badge-success">Réglé</span>
                                                    @else
                                                    <span class="badge badge-danger"> réglé</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-info text-white" href="{{route('facture.edit',['facture'=>$facture->id])}}"><i class="fa fa-edit"></i></a>
                                                    <a href="{{route('facture.destroy',['facture'=>$facture->id])}}" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a>
                                                    <a href="{{route('facture.print',['facture'=>$facture->id])}}"  class="btn btn-danger text-white"><i class="fa fa-print"></i></a>
                                                    <a class="btn btn-primary" href="{{route('payment.facture',['facture'=>$facture->id])}}">
                                                            Paiments
                                                        </a>

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
        $('.analyse-checkbox').change(function(){
        console.log('test')
        var checks = $(".analyse-checkbox:checked"); // returns object of checkeds.
        console.log(checks)
        var hrefDelete = "/facture/supprimer/list?id=";
        for(var i=0; i<checks.length; i++){
            hrefDelete =hrefDelete +$(checks[i]).val()+",";
            $('#hrefDelete').attr('href',hrefDelete)
        }
    });

</script>
@endsection
