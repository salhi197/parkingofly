@extends('layouts.master')

@section('page_wrapper')
@include('includes.settings')



@endsection

@section('content')


<div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-primary right" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-plus"></i> Ajouter Norme
                                    </button>
                                </h4>
                                
                                <div class="table-responsive">
                                    <table id="zero_config" id="DataTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Norme</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($normes as $norme)
                                            <tr>
                                                <td>{{$norme->id }}</td>
                                                <td>{{$norme->valeur ?? ""}}</td>
                                                <td>
                                                    <a class="btn btn-info text-white" href="{{route('norme.edit',['norme'=>$norme->id])}}"><i class="fa fa-edit"></i></a>
                                                    <a href="{{route('norme.destroy',['norme'=>$norme->id])}}" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a>
                                                </td>
                                            </tr>

                                            @endforeach                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter norme</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
            <form id="normeFform" action="{{route('norme.create')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label class="small mb-1" for="inputFirstName">norme: </label>
                    <input type="text" name="valeur"  class="form-control"/>
                </div>    
                <button class="btn btn-primary btn-block" type="submit" id="ajax_norme">Ajouter </button>
            </form>
      </div>
    </div>
  </div>
</div>
@endsection