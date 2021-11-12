@extends('layouts.master')


@section('styles')
<link href="{{asset('css/ticket.css')}}" rel="stylesheet">
<style></style>
@endsection
@section('content')

                                <div class="container-fluid">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <form method="post" action="/reservation/caisse/filter" >                                                    
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-2" >
                                                        <label class="control-label">{{ __('Début') }}: </label>
                                                        <input class="form-control" value="{{$date_debut ?? ''}}" name="date_debut" type="date" />
                                                    </div>

                                                    <div class="col-md-2" >
                                                        <label class="control-label">{{ __('Fin') }}: </label>
                                                        <input class="form-control" value="{{$date_fin ?? ''}}" name="date_fin" type="date" />
                                                    </div>

                                                   <div class="col-md-2" style="padding:35px;">
                                                        <button type="submit" class="row btn btn-primary" >
                                                            Filtrer
                                                        </button>                                                                                                        
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="card-group">
                                            <div class="card border-right">
                                                <div class="card-body">
                                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                                        <div>
                                                            <div class="d-inline-flex align-items-center">
                                                                <h2 class="text-dark mb-1 font-weight-medium">{{$total ?? ''}} DA</h2>
                                                            </div>
                                                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total revenue </h6>
                                                        </div>
                                                        <div class="ml-auto mt-md-3 mt-lg-0">
                                                            <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card border-right">
                                                <div class="card-body">
                                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                                        <div>
                                                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                                                    class="set-doller">DA</sup>{{$totalToday ?? ''}}</h2>
                                           