@extends('layouts.master')



@section('content')

<div class="container-fluid">

                        <h1 class="mt-4">Historique Stock</h1>

                             <div class="card mb-4">

                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                        <thead>

                                            <tr>
                                                <th>nom wilaya </th>
                                                <th>montant</th>  
                                                                                              
                                                <th>Action</th>    
                                            </tr>

                                        </thead>

                                        <tbody>

                                            @foreach($wilayas as $wilaya)                                            
                                            <tr class="produit">
                                                <td>{{$wilaya->name ?? ''}} </td>
                                                <td>{{$wilaya->fournisseur ?? ''}} (D.A) </td>
                                                <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$wilaya->id ?? ''}}">
                                                            Montant
                                                        </button>                                                                                                        

                                                </td>
                                            </tr>

                                                    <div class="modal fade" id="exampleModal{{$wilaya->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Montant : </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('wilaya.fournisseur')}}" method="post">
                                                            @csrf
                                                                    <div class="col-md-6">
                                                                            <label class="small mb-1" for="inputEmailAddress">Quantit?? : </label>
                                                                            <input type="number" class="form-control " name="fournisseur" id="fournisseur" placeholder="Montant Fournisseur : ";>
                                                                            <input type="hidden" class="form-control " name="wilaya" id="montant" value="{{$wilaya->id ?? ''}}">
                                                                        </div>
                                                                        <br>
                                                                <button type="submit" class="btn btn-primary" >
                                                                            Envoyer
                                                                        </button>                                                                                                        

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

                    </div>






@endsection

@section('scripts')
@endsection
