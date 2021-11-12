@extends('layouts.master')



@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouveau Client  </h3></div>
                                    <div class="card-body">
                                        <form role="form" action="{{route('operateur.update',['operateur'=>$operateur->id])}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label>Nom</label>
                                                        <input type="text" value="{{$operateur->nom}}" name="nom" class="form-control" required="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label>Login (email)</label>
                                                        <input type="text" value="{{$operateur->email}}" name="email" class="form-control" autocomplete="off">
                                                    </div> 
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label>Mot de passe</label>
                                                        <input type="text" value="{{$operateur->password_text}}" name="password" class="form-control">
                                                    </div> 
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Rôle</label>
                                                        <select class="form-control" value="{{$operateur->role}}" name="role">
                                                            <option value="Administrateur" @if($operateur->role == "Administrateur") selected @endif>Administrateur</option>
                                                            <option value="Utilisateur" @if($operateur->role == "operateur") selected @endif>Operateur</option>
                                                        </select>
                                                    </div> 
                                                </div>


                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Type</label>
                                                        <select class="form-control" name="type">
                                                            <option value="1" @if($operateur->type ==1) selected @endif>Microbiologie</option>
                                                            <option value="2" @if($operateur->type ==2) selected @endif>Physico-chimie</option>
                                                        </select>
                                                    </div> 
                                                </div>


                                                <div class="col-sm-2">
                                                    <label>&nbsp;</label>
                                                    <button type="submit" id="valider" class="btn btn-info btn-block">Ok</button>
                                                </div>
                                            </div>
                                        </form>


                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    









@endsection



