@extends('layouts.master')

@section('page_wrapper')
@include('includes.settings')



@endsection

@section('content')


<div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                <button type="button" class="btn btn-primary right" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-plus"></i> Ajouter
                                </button>

                                </h4>
                                
                                <div class="table-responsive">
                                    <table id="zero_config" id="DataTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Type</th>
                                                <th>Value</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($organos as $organo)
                                            <tr>
                                                <td>{{$organo->id }}</td>
                                                <td>
                                                    
                                                    @if($organo->type==1) Aspect & couleur @endif

                                                    @if($organo->type==2) Gout & Odeur @endif

                                                    @if($organo->type==3) Examen Macroscopique @endif

                                                </td>
                                                <td>{{$organo->value }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary right" data-toggle="modal" data-target="#exampleModal{{$organo->id}}">
                                                        Modifier
                                                    </button>
                                                    <a href="{{route('organo.destroy',['organo'=>$organo->id])}}" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="exampleModal{{$organo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Ajouter organo : </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('organo.update',['id_organo'=>$organo->id ?? 1])}}">
                                                            @csrf
                                                                <div class="form-group">
                                                                    <label class="small mb-1" for="inputFirstName">organo: </label>
                                                                    <select class="form-control "  value="{{old('client')}}" name="type">
                                                                        <option value="">séléctionner le type</option>
                                                        <option value="1" @if($organo->type==1) selected @endif >Aspect & couleur</option>
                                                        <option value="2" @if($organo->type==2) selected @endif >Gout & Odeur</option>
                                                        <option value="3" @if($organo->type==3) selected @endif >Examen Macroscopique</option>
                                                                    </select>

                                                                </div>    

                                                                <div class="form-group">
                                                                    <label class="small mb-1" for="inputFirstName">Valeur: </label>
                                                                    <input type="value" value="{{$organo->value}}" name="value"   class="form-control"/>
                                                                </div>    
                                                                <button class="btn btn-primary btn-block" type="submit" id="ajax_organo">ajouter organo</button>
                                                            </form>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>




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
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter organo : </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                        <form id="organoFform" action="{{route('organo.create')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputFirstName">organo: </label>
                                                <select class="form-control "  value="{{old('client')}}" name="type">
                                                    <option value="">séléctionner le type</option>
                                                    <option value="1" >Aspect & couleur</option>
                                                    <option value="2" >Gout & Odeur</option>
                                                    <option value="3" >Examen Macroscopique</option>
                                                </select>

                                            </div>    

                                            <div class="form-group">
                                                <label class="small mb-1" for="inputFirstName">Valeur: </label>
                                                <input type="value" name="value"  class="form-control"/>
                                            </div>    
                                            <button class="btn btn-primary btn-block" type="submit" id="ajax_organo">ajouter organo</button>
                                        </form>
                                </div>
                                </div>
                            </div>
                        </div>

@endsection