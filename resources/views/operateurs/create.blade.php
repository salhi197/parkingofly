@extends('layouts.master')



@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouveau Operateur  </h3></div>
                                    <div class="card-body">
                                        <form role="form" action="{{route('operateur.store')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Nom</label>
                                                        <input type="text" name="nom" class="form-control" required="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Login (email)</label>
                                                        <input type="text" name="email" class="form-control" autocomplete="off">
                                                    </div> 
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label>Mot de passe</label>
                                                        <input type="password" name="password" class="form-control">
                                                    </div> 
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label>Rôle</label>
                                                        <select class="form-control" name="role">
                                                            <option value="Administrateur">Administrateur</option>
                                                            <option value="operateur">Operateur</option>
                                                        </select>
                                                    </div> 
                                                </div>


                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label>Type</label>
                                                        <select class="form-control" name="type">
                                                            <option value="1">Microbiologie</option>
                                                            <option value="2">Physico-chimie</option>
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



