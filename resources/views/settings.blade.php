@extends('layouts.master')

@section('page_wrapper')
@endsection

@section('content')

<div class="row-fluid">
        <div class="col-md-12">
            <h2><i class="glyphicon glyphicon-user"></i> Paramètre  </h2>
         </div>   
        <div class="col-md-12">
             <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Library</li>
              </ol>
            </nav>
         </div>
         
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        Total Jour
                      </div>
                      <div class="card-body">
                        <form action="{{route('setting.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tarif :</label>
                                    <input type="text" value="{{ $tarif ?? '' }}" name="tarif" class="form-control" id="exampleInputtarif1" placeholder="Tarif ">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="submit" value="envoyer" class="btn btn-info" id="exampleInputtarif1" placeholder="Tarif ">
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <br>
            
            

    </div>



@endsection