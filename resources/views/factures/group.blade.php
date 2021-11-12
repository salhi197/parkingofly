@extends('layouts.master')

@section('page_wrapper')
@endsection

@section('content')

<div class="container-fluid">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Filtrer Les Analyses Par Client </h3></div>
                                    <div class="card-body">
                                        <div class="leftSide"><!-- Begin of content -->
                                            <form action="{{route('facture.group')}}" id="Factureform" method="post">
                                            @csrf
                                                <div class="row">

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Date Début</label>
                                                            <input type="date" name="date_debut" value="{{$date_debut}}" class="form-control">
                                                        </div>                                     
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Date Fin</label>
                                                            <input type="date" name="date_fin" value="{{$date_fin}}" class="form-control">
                                                        </div>                                     
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">client :</label>
                                                            <select class="form-control clients"  value="{{old('client')}}" name="client" >
                                                                    <option value="">séléctionner client</option>
                                                                    @foreach($clients as $client)
                                                                        <option value="{{$client->id}}">{{$client->nom}}</option>
                                                                    @endforeach
                                                            </select>

                                                        </div>
                                                    </div>

                                                </div>




                                                <br>

                                                    <button class="btn btn-info" type="submit">valider</button>
                                           </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    









@endsection



@section('scripts')
<script>

$(document).ready(function() {
        var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus5", "#minus5", {
            limit:10,
            formPrefix : "dynamic_form",
            normalizeFullForm : false
        });


        $("#dynamic_form #minus5").on('click', function(){
            var initDynamicId = $(this).closest('#dynamic_form').parent().find("[id^='dynamic_form']").length;
            if (initDynamicId === 2) {
                $(this).closest('#dynamic_form').next().find('#minus5').hide();
            }
            $(this).closest('#dynamic_form').remove();
        });

        $('form').on('submit', function(event){
            var values = {};
            $.each($('form').serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            // console.log(values)
            // event.preventDefault();
        })

        $(document).on('change', '.types', function(e) {
            var id = this.id;
            var l = id.length
            var valueSelected = this.value;
            console.log(valueSelected,id)
            if(valueSelected =="micro"){
                $("#setting"+index).append(('<option value="'+found.reference+'" selected="selected">'+found.reference+'</option>'));
            }
        })



});

</script>
@endsection