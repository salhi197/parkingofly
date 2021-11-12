@extends('layouts.master')

@section('page_wrapper')
@include('includes.settings')



@endsection

@section('content')


<div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{route('reference.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> Ajouter reference</a>
                                </h4>
                                
                                <div class="table-responsive">
                                    <table id="zero_config" id="DataTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Determination</th>
                                                <th>Produit</th>
                                                <th>Methode</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($references as $reference)
                                            <tr>
                                                <td>{{$reference->type }}</td>
                                                <td>{{$reference->determination}}</td>
                                                <td>{{$reference->getProduit()['designation'] ?? ''}}</td>
                                                <td>{{$reference->methode}}</td>

                                                <td>
                                                    <a class="btn btn-info text-white" href="{{route('reference.edit',['reference'=>$reference->id])}}"><i class="fa fa-edit"></i></a>
                                                    <a href="{{route('reference.destroy',['reference'=>$reference->id])}}" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a>
                                                </td>
                                            </tr>

                                            @endforeach                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


@endsection