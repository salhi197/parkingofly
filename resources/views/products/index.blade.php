@extends('layouts.master')



@section('content')

<div class="container-fluid">

                        <h1 class="mt-4">Gestion products</h1>

                             <div class="card mb-4">
                            <div class="card-header">
                                <a class="btn btn-primary" href="{{route('product.create')}}">
                                <i class="fa fa-plus"></i> Ajouter product</a>
                            </div>

                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                        <thead>

                                            <tr>

                                                <th>ID product</th>
                                                <th>Nom product </th>
                                                <th>qunatité-stock</th>
                                                <th>actions</th>

                                                

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @foreach($products as $product)                                            

                                            <tr>

                                                <td>{{$product->id ?? ''}}</td>

                                                <td> <i class=" fas fa-box	"></i> {{$product->name ?? ''}}
                                                <br>
                                                <?php 
                                                $image = json_decode($product->image);
                                                ?>

                                                </td>
                                                <?php
                                                    $fournisseur = json_decode($product->fournisseur); 
                                                ?>

                                                <td><span class="badge badge-info"> {{$product->quantite ?? ''}} pieces </span></td>
                                                <td >

                                                    <div class="table-action">  
                                                        <a  
                                                        href="{{route('product.destroy',['id_product'=>$product->id])}}"
                                                        onclick="return confirm('etes vous sure  ?')"
                                                        class="text-white btn btn-danger">
                                                                <i class="fas fa-trash"></i> 
                                                        </a>
                                                        <a 
                                                            href="{{route('product.edit',['id_product'=>$product->id])}}"
                                                            class="text-white btn btn-info">
                                                                <i class="fas fa-edit"></i>  
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>





@endsection

