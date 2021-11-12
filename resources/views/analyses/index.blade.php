@extends('layouts.master')

@section('page_wrapper')
@endsection

@section('content')


                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    @auth('admin')
                                    <a class="btn btn-info" href="{{route('analyse.create')}}"><i class="fa fa-plus"></i> Ajouter analyse</a>
                                    @endif
                                    <a class="btn btn-danger" href="" id="hrefDelete">Supprimer la séléction </a>

                                </h4>

                                <form method="post" action="{{route('analyse.filter')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date Début</label>
                                                <input type="date" name="date_debut" value="{{$date_debut}}" class="form-control">
                                            </div>                                     
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date Fin</label>
                                                <input type="date" name="date_fin" value="{{$date_fin}}" class="form-control">
                                            </div>                                     
                                        </div>

                                        <div class="col-sm-2">
                                            <label>&nbsp;</label>
                                            <button type="submit" id="valider" class="btn btn-info btn-block">filter</button>
                                        </div>



                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table id="zero_config" id="DataTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Id</th>                                                
                                                <th>Date </th>                                                
                                                <th>code</th>                                                
                                                <th>Etat</th>                                                
                                                <th>Client</th>
                                                <!-- <th>Categorie</th> -->
                                                <th>Produit</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($analyses as $analyse)
                                            <tr>
                                                <td>
                                                <input type="checkbox" value="{{$analyse->id}}" class="form-check-input all analyse-checkbox" id="exampleCheck{{$analyse->wilaya }}">

                                                {{$analyse->id ?? ''}}
                                                </td>
                                                <td>
                                                    {{
                                                        date('d/m/Y', strtotime($analyse->prelevement))
                                                    }}
                                                </td>

                                                <td>
                                                    <span style="font-size:17px;" class="badge badge-info">
                                                    @if($analyse->valider == 0)
                                                        Non Valider
                                                    @else
                                                        Valider
                                                    @endif
                                                    </span>
                                                </td>
                                                <!-- <td>{{$analyse->lot}}</td> -->
                                                <td>{{$analyse->getClient()['nom'] ?? ''}}</td>
                                                <!-- <td>{{$analyse->getCategorie()['label'] ?? ''}}</td> -->
                                                <td>{{$analyse->getProduit()['designation'] ?? ''}}</td>
                                                <td>
                                                    @if($analyse->type_analyse_1 == 1)
                                                        Physico-chimique ,
                                                    @endif
                                                    
                                                    @if($analyse->type_analyse_2 == 1)
                                                        Micro-biologique ,                                                      
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-info text-white" href="{{route('analyse.edit',['analyse'=>$analyse->id])}}"><i class="fa fa-edit"></i></a>
                                                    <a href="{{route('analyse.destroy',['analyse'=>$analyse->id])}}" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a>
                                                    @if($analyse->type_analyse_1 == 1)
                                                        <a target="_blank" href="{{route('analyse.print.physico',['analyse'=>$analyse->id])}}"  class="btn btn-danger text-white">
                                                            <i class="fa fa-print"></i> Physico
                                                        </a>
                                                    @endif
                                                    
                                                    @if($analyse->type_analyse_2 == 1)
                                                        <a target="_blank" href="{{route('analyse.print.micro',['analyse'=>$analyse->id])}}"  class="btn btn-danger text-white">
                                                            <i class="fa fa-print"></i> Micro
                                                        </a>
                                                    @endif
                                                    <!-- <a target="_blank" href="{{route('analyse.print',['analyse'=>$analyse->id])}}"  class="btn btn-danger text-white"><i class="fa fa-print"></i></a> -->

                                                    @if($analyse->valider == 0)
                                                        <a href="{{route('analyse.valider',['analyse'=>$analyse->id])}}"  class="btn btn-danger text-white">
                                                            <i class="fa fa-check"></i> Valider
                                                        </a>
                                                    @endif


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


    $('.analyse-checkbox').change(function(){
        console.log('test')
        var checks = $(".analyse-checkbox:checked"); // returns object of checkeds.
        console.log(checks)
        var hrefDelete = "/analyse/supprimer/list?id=";
        for(var i=0; i<checks.length; i++){
            hrefDelete =hrefDelete +$(checks[i]).val()+",";
            $('#hrefDelete').attr('href',hrefDelete)
        }
    });
})
</script>
@endsection
