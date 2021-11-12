@extends('layouts.master')

@section('page_wrapper')
@endsection

@section('content')

<div class="container-fluid">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouvelle Analyse  </h3></div>
                                    <div class="card-body">
                                        <div class="leftSide"><!-- Begin of content -->
                                            <form action="{{route('analyse.store')}}" method="post">
                                            @csrf
                                            <input type="hidden" id="produits" value="{{$produits}}" />
                                            <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <table class="table results"></table>
                                                        </div>
                                                    </div>
                                                    <div class="well">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                <label for="">Nature du Produit:</label>
                                                                    <select class="form-control produits" id="produit" value="{{old('produit')}}" name="produit">
                                                                        <option value="">séléctionner Produit</option>
                                                                        @foreach($produits as $produit)
                                                                            <option value="{{$produit->id}}">{{$produit->designation}}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="">Categorie :</label>
                                                                    <select class="form-control categories"  value="{{old('categorie')}}" name="categorie">
                                                                        @foreach($categories as $categorie)
                                                                            <option value="{{$categorie->id}}">{{$categorie->label}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="">Nom Commercial</label>
                                                                    <input type="text" class="form-control" id="marque" value="{{old('marque')}}" name="marque">
                                                                </div>
                                                            </div> 


                                                            <!-- <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="">Libellé Produit</label>
                                                                    <div>
                                                                        <select class="form-control lib_produit" value="{{old('lib_produit')}}" name="lib_produit">
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>  -->
                                                        </div>
                                                    </div>

                                                    <div class="well sm">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                <label for="">client :</label>
                                                                    <select class="form-control "  value="{{old('client')}}" name="client">
                                                                    <option value="" >séléctionner client</option>
                                                                        @foreach($clients as $client)
                                                                            <option
                                                                            value="{{$client->id}}"
                                                                            @if(old('client')==$client->id) selected @endif
                                                                            >{{$client->nom}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">&nbsp;</label>
                                                                    <select value="{{old('type')}}" name="type" id="faitpar" class="form-control">
                                                                        <option value="1"> fait par les soins du laboratoire </option>
                                                                        <option value="0"> fait par les soins du propriétaire </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">         
                                                                <div class="form-group">
                                                                    <label>Le :</label>
                                                                    <input type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31"  value="{{old('prelevement')}}" name="prelevement" id="prelevement" class="form-control mesdates">
                                                                </div>
                                                            </div>

                                                            <!-- <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="">Code barre</label>
                                                                    <input type="text" class="form-control" id="code_barre" value="{{old('code_barre')}}" name="code_barre">
                                                                </div>
                                                            </div>  -->
                                                        </div>
                                                    </div>


                                                    <!-- <div class="well autres hidden">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">Autres Produits :</label>
                                                                    <input type="text" value="{{old('nomproduit')}}" name="nomproduit" id="produit" value="" autocomplete="off" placeholder="tapez une famille" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <table class="table resultsp"></table>
                                                        </div>
                                                    </div>
                                                    <div class="well">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label for="">Contenance</label>
                                                                    <select class="form-control" id="contenance" value="{{old('contenance')}}" name="contenance">
                                                                        <option value="Poids">Poids</option>
                                                                        <option value="Volume">Volume</option>
                                                                    </select>
                                                                </div>
                                                            </div> 

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="">Valeur</label>
                                                                    <input type="text" class="form-control" id="valeur" value="{{old('valeur')}}" name="valeur">
                                                                </div>
                                                            </div> 


                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>Date de fabrication</label>
                                                                    <input type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" value="{{old('fabrication')}}" name="fabrication" id="fabrication" class="form-control mesdates">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">        
                                                                <div class="form-group ">
                                                                    <label>Date peremption</label>
                                                                    <input type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" value="{{old('peremption')}}" name="peremption" id="peremption" class="form-control mesdates">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>N° lot</label>
                                                                    <input type="text" value="{{old('lot')}}" name="lot" id="lot" class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>Date d'analyse </label>
                                                                    <input type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" value="{{old('data_analyse')}}" name="data_analyse" id="data_analyse" class="form-control mesdates">
                                                                </div>
                                                            </div> 


                                                        </div>
                                                    </div>
                                                    <div class="well">
                                                        <div class="row">
                                                            <!-- <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>Date de reception</label>
                                                                    <input type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" value="{{old('reception')}}" name="reception" id="reception" class="form-control mesdates">
                                                                </div>
                                                            </div>  -->
                                                        </div>
                                                    </div>
                                                    <div class="well">
                                                                <div class="row">
                                                                        <div class="col-sm-3">         
                                                                            <div class="form-group">
                                                                                <label>Type D'analyse</label>
                                                                                <!-- <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="type_analyse"  value="1" id="flexRadioDefault1" >
                                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                                    Analyse Physico-chimique
                                                                                    </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="type_analyse" value="0" id="flexRadioDefault2" checked>
                                                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                                                    Analyse Micro-biologique
                                                                                    </label>
                                                                                </div>                                                         -->

                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="type_analyse_1" id="defaultCheck1">
                                                                                    <label class="form-check-label" for="defaultCheck1">
                                                                                    Analyse Physico-chimique
                                                                                    </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="type_analyse_2" id="defaultCheck2">
                                                                                    <label class="form-check-label" for="defaultCheck2">
                                                                                    Analyse Micro-biologique
                                                                                    </label>
                                                                                </div>



                                                                            </div>
                                                                        </div>
                                                                </div>

                                                        <br>
                                                        <label>
                                                            Format d'analyse 
                                                        </label>
                                                        <br>
                                                    </div>




                                                    <br>
                                                </div>
                                            
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
    $('.produits').select2();
    $('.settings').select2();

    var categories  = {!! json_encode($categories->toArray()) !!};
    $('.categories').on('change',function(){
        var valueSelected = this.value;
        const found = categories.find(element => element.id == valueSelected);
        console.log(found)
        $('#conformite1').val(found.conformite1)
        $('#conformite2').val(found.conformite2)
    })




    $('.js-example-basic-multiple').select2();


    var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus5", "#minus5", {
        limit:10,
        formPrefix : "dynamic_form",
        normalizeFullForm : false
    });




    $("#dynamic_form #minus5").on('click', function(){
        console.log('s')
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
    })

    $('input[type=radio][name=type_analyse]').change(function() {
        if (this.value == 0) {
            $('.extra').show(1000);
        }
        else if (this.value == 1) {
            $('.extra').hide(1000);
        }
    });

    $('#produit').on('change',function(){
        var id = this.value
        var url = '/analyse/create/produit/'+id
        window.location.href = url;
    })

    // var produits = $('#produits').val()
    // produits= JSON.parse(produits)
    // console.log(produits)
    // $('#produit').on('change',function(){
    //     var id = this.value
    //     var obj;
    //     var references,unites,unite
    //     for (let index = 0; index < produits.length; index++) {
    //         if (produits[index]['id']==id) {
    //             console.log(produits[index])
    //             // $('#aspect_couleur').val(produits[index]['aspect_couleurs']);
    //             // $('#gout_odeur').val(produits[index]['gout_odeurs']);
    //             unites = JSON.parse(produits[index]['unites']);
    //             references = JSON.parse(produits[index]['_references']);
    //             console.log(unites,references)                
    //             for (let index = 0; index < unites.length; index++) {
    //                 unite = JSON.parse(unites[index]);
    //                 console.log(unite)
    //                 $('#unites').empty();
    //                 $('#unites').append(`<option value="${unite}">
    //                                    ${unite.nom}
    //                               </option>`);


    //             }

    //         }      
    //     }
    // })
});

</script>
@endsection