@extends('layouts.master')

@section('page_wrapper')
@endsection

@section('content')
                    <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select class="form-control" name="product">
                                            <option value="all">Produit</option>                                            
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                <h4 class="card-title">
                                    <a href="{{route('stock.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> Ajouter produit</a>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#entrer">
                                        Entré 
                                    </button>

                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sortie">
                                        Sortie
                                    </button>
                                </h4>


                                </div>
                            


                                <div class="table-responsive">
                                    <table id="zero_config" id="DataTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>                                                
                                                <th>produit</th>
                                                <th>fournisseur</th>
                                                <th>prix achat</th>
                                                <th>quantité</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($stocks as $stock)
                                            <tr>
                                                <td>{{$stock->id ?? ''}}</td>                                                
                                                <td>{{$stock->getProduit()['designation'] ?? ''}}</td>
                                                <td>{{$stock->fournisseur ?? ''}}</td>
                                                <td>{{$stock->prix ?? ''}}</td>
                                                <td>{{$stock->quantite ?? ''}}</td>
                                                <td><span class="badge badge-info">{{$stock->type}}</span</td>
                                                <td>
                                                    <a class="btn btn-info text-white" href="{{route('stock.edit',['stock'=>$stock->id])}}"><i class="fa fa-edit"></i></a>
                                                    <a href="{{route('stock.destroy',['stock'=>$stock->id])}}" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="sortie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Sortie</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form methof="{{route('stock.sortie')}}" action="post">
                                        <input type="hidden" class="form-control" value="-1" name="type">
                                        <div class="form-group">
                                            <label for="">Produit : </label>
                                            <select class="form-control" name="produit">
                                            </select>
                                            <input type="text" class="form-control" id="fournisseur" value="{{old('fournisseur')}}" name="fournisseur">
                                        </div>
                                        <div class="form-group">
                                            <label for="">quantite : </label>
                                            <input type="text" class="form-control" id="fournisseur" value="{{old('fournisseur')}}" name="fournisseur">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="entrer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Entré</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form methof="{{route('stock.entrer')}}" action="post">
                                        <input type="hidden" class="
                                        form-control" value="-1" name="type">
                                        <div class="form-group">
                                            <label for="">Produit : </label>
                                            <select class="form-control" name="product">
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">quantite : </label>
                                            <input type="text" class="form-control" id="fournisseur" value="{{old('fournisseur')}}" name="fournisseur">
                                        </div>
                                    </form>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                                </div>
                            </div>
                        </div>

@endsection