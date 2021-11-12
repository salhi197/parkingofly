@extends('layouts.master')

@section('page_wrapper')
@endsection

@section('content')


<div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a class="btn btn-info" href="{{route('setting.create.type',['type'=>'physico-chimique'])}}">
                                        <i class="fa fa-plus"></i>
                                         Ajouter Paramètre Physico-chimique
                                    </a>
                                    <a class="btn btn-info" href="{{route('setting.create.type',['type'=>'micro-biologique'])}}">
                                        <i class="fa fa-plus"></i>
                                         Ajouter Paramètre Micro-biologique
                                    </a>
                                </h4>
                                
                                <div class="table-responsive">
                                    <table id="zero_config" id="DataTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Determination</th>
                                                <th>Prix</th>
                                                <th>Duree</th>
                                                <th>Type</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($settings as $setting)
                                            <tr>
                                                <td>{{$setting->id }}</td>
                                                <td>{{$setting->determination}}</td>
                                                <td>{{$setting->prix ?? ''}} DA</td>
                                                <td>{{$setting->duree ?? ''}}</td>
                                                <td>
                                                    <span class="badge badge-info">
                                                        {{$setting->type ?? ''}}                                                    
                                                    </span>
                                                </td>                                                
                                                <td>
                                                    <a class="btn btn-info text-white" href="{{route('setting.edit',['setting'=>$setting->id])}}"><i class="fa fa-edit"></i></a>
                                                    <a href="{{route('setting.destroy',['setting'=>$setting->id])}}" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a>
                                                </td>
                                            </tr>

                                            @endforeach                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


@endsection