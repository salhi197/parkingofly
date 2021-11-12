@extends('layouts.master')

@section('content')


                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{route('operateur.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> Ajouter</a>
                                </h4>
                                
                                <div class="table-responsive">
                                    <table id="zero_config" id="DataTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Nom</th>
                                                <th>lOGIN</th>
                                                <th>password</th>
                                                <th>Role</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($operateurs as $operateur)
                                            <tr>
                                                <td>{{$operateur->id }}</td>
                                                <td>{{$operateur->nom}}</td>
                                                <td>{{$operateur->email ?? ''}}</td>
                                                <td>{{$operateur->password_text ?? ''}}</td>
                                                <td>{{$operateur->role ?? ''}}</td>
                                                <td>
                                                    @if($operateur->type == 1)
                                                        <span class="badge badge-info">
                                                        Microbiologie
                                                        </span>
                                                    @else
                                                        <span class="badge badge-info">
                                                        Physico-chimie                                                    
                                                        </span>
                                                    @endif
                                                </td>

                                                <td>
                                                <a class="btn btn-info text-white" href="{{route('operateur.edit',['operateur'=>$operateur->id])}}"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('operateur.destroy',['operateur'=>$operateur->id])}}" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a>

                                                </td>
                                            </tr>
                                            @endforeach                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


@endsection