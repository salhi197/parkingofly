@extends('layouts.master')



@section('content')

<div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Modifier Produit :  </h3></div>
                                        <div class="card-body">
                                            <form role="form" id="global" action="{{route('produit.update',['produit'=>$produit->id])}}" method="post">
                                            @csrf
                                                <input type="hidden" name="type" value="{{$type}}" required="" class="form-control">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Catégorie Produits</label>
                                                            <select class="form-control" name="categorie">
                                                                @foreach($categories as $categorie)
                                                                <option value="{{$categorie->id}}">{{$categorie->label}}</option>						 
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>
                                                            Nature du Produit: 
                                                            </label>
                                                            <input type="text" name="designation" required="" value="{{$produit->designation}}" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach($rows1 as $key1=>$row1)
                                                <input value="{{$row1->id}}" name="d[{{$key1}}][id]" type="hidden" />
                                                <div class="form-group" >
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Paramètre</label>
                                                                    <select id="select_setting" class="form-control" name="d[{{$key1}}][setting]"  >
                                                                        <option>--------------</option>						 
                                                                        @foreach($settings1 as $setting1)
                                                                            @if($setting1->type=="physico-chimique")
                                                                                <option @if($setting1->determination == $row1->setting) selected @endif value="{{$setting1->determination}}">{{$setting1->determination}}</option>						 
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                    <a style="cursor: pointer;" data-toggle="modal" data-target="#createsetting">
                                                                        <i class="fa fa-plus"></i>
                                                                        &nbsp; Ajouter Paramètre 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Référence</label>
                                                                    <select class="form-control" name="d[{{$key1}}][_reference]"  >
                                                                        @foreach($references1 as $reference1)
                                                                        <option @if($reference1->determination == $row1->reference) selected @endif value="{{$reference1->determination}}">{{$reference1->determination}}</option>						 
                                                                        @endforeach
                                                                    </select>
                                                                    <a style="cursor: pointer;" data-toggle="modal" data-target="#createreference">
                                                                        <i class="fa fa-plus"></i>
                                                                        &nbsp; Ajouter Référence 
                                                                    </a>
                                                                </div>                               
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Unité</label>
                                                                    <select class="form-control" name="d[{{$key1}}][unite]"  >
                                                                        @foreach($unites1 as $unite1)
                                                                        <option @if($unite1->nom == $row1->unite) selected @endif value="{{$unite1->nom}}">{{$unite1->nom}}</option>						 
                                                                        @endforeach
                                                                    </select>
                                                                    <a style="cursor: pointer;" data-toggle="modal" data-target="#createunite">
                                                                        <i class="fa fa-plus"></i>
                                                                        &nbsp; Ajouter Unité 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label for="">Norme</label>
                                                                    <!-- <select class="form-control" name="d[{{$key1}}][norme]" id="select_norme">
                                                                        @foreach($normes1 as $norme1)
                                                                        <option @if($norme1->valeur == $row1->norme) selected @endif value="{{$norme1->valeur}}">{{$norme1->valeur ?? ""}}</option>						 
                                                                        @endforeach
                                                                    </select>

                                                                    <a data-toggle="modal" style="cursor: pointer;" data-target="#createnorme">
                                                                        <i class="fa fa-plus"></i>
                                                                        Ajouter Norme
                                                                    </a> -->
                                                                    <input type="text" value="{{$row1->norme ?? '' }}" name="norme1" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                @endforeach


                                                <div class="form-group" id="dynamic_form">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Paramètre</label>
                                                                    <select id="select_setting1" class="form-control settings1"  name="setting1">
                                                                        <option value="">Séléctionner</option>						 
                                                                        @foreach($settings1 as $setting1)
                                                                            <option value="{{$setting1->determination}}" id="{{$setting1->id}}">{{$setting1->determination}}</option>						 
                                                                        @endforeach
                                                                    </select>
                                                                    <a style="cursor: pointer;" data-toggle="modal" data-target="#createsetting">
                                                                        <i class="fa fa-plus"></i>
                                                                        &nbsp; Ajouter Paramètre 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Référence</label>
                                                                    <select class="form-control _references1"  name="_reference1" id="select_reference1">
                                                                        <option value="">Séléctionner</option>						 

                                                                        @foreach($references1 as $reference1)
                                                                        <option value="{{$reference1->determination}}">{{$reference1->determination}}</option>						 
                                                                        @endforeach
                                                                    </select>
                                                                    <a style="cursor: pointer;" data-toggle="modal" data-target="#createreference">
                                                                        <i class="fa fa-plus"></i>
                                                                        &nbsp; Ajouter Référence 
                                                                    </a>
                                                                </div>                               
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Unité</label>
                                                                    <select class="form-control unites1"  name="unite1" id="select_unite1">
                                                                        <option value="">Séléctionner</option>						 

                                                                        @foreach($unites1 as $unite1)
                                                                        <option value="{{$unite1->nom}}">{{$unite1->nom}}</option>						 
                                                                        @endforeach
                                                                    </select>
                                                                    <a style="cursor: pointer;" data-toggle="modal" data-target="#createunite">
                                                                        <i class="fa fa-plus"></i>
                                                                        &nbsp; Ajouter Unité 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label for="">Norme</label>
                                                                    <!-- <select class="form-control normes1" name="norme1" id="select_norme1">
                                                                        <option value="">Séléctionner</option>						 

                                                                        @foreach($normes1 as $norme1)
                                                                        <option value="{{$norme1->valeur}}">{{$norme1->valeur ?? ""}}</option>						 
                                                                        @endforeach
                                                                    </select>
                                                                    <a data-toggle="modal" style="cursor: pointer;" data-target="#createnorme">
                                                                        <i class="fa fa-plus"></i>
                                                                        Ajouter Norme
                                                                    </a> -->
                                                                    <input type="text" value="{{$produit->norme ?? '' }}" name="norme2" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="button-group">
                                                                <label>Action</label><br>
                                                                <a href="javascript:void(0)" class="btn btn-primary" id="plus5"><i class="fa fa-plus"></i></a>
                                                                <a href="javascript:void(0)" class="btn btn-danger" id="minus5"><i class="fa fa-minus"></i></a>
                                                            </div>
                                                        </div> 
                                                </div>


                                            <hr>

                                                <hr>
                                                <hr>
                                                <hr>
                                                <br>
                                                <label>
                                                    Paramètres Micro: 
                                                </label>


                                                @foreach($rows2 as $key2=>$row2)
                                                <input value="{{$row2->id}}" name="d2[{{$key2}}][id]" type="hidden" />
                                                <div class="form-group" >
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Paramètre</label>
                                                                    <select id="select_setting" class="form-control" name="d2[{{$key2}}][setting]"  >
                                                                        <option>--------------</option>						 

                                                                        @foreach($settings2 as $setting2)
                                                                            @if($setting2->type=="micro-biologique")
                                                                                <option @if($setting2->determination == $row2->setting) selected @endif value="{{$setting2->determination}}">{{$setting2->determination}}</option>						 
                                                                            @endif                                                                        
                                                                        @endforeach
                                                                    </select>
                                                                    <a style="cursor: pointer;" data-toggle="modal" data-target="#createsetting">
                                                                        <i class="fa fa-plus"></i>
                                                                        &nbsp; Ajouter Paramètre 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Référence</label>
                                                                    <select class="form-control" name="d2[{{$key2}}][_reference]"  >
                                                                        @foreach($references2 as $reference2)
                                                                        <option @if($reference2->determination == $row2->reference) selected @endif value="{{$reference2->determination}}">{{$reference2->determination}}</option>						 
                                                                        @endforeach
                                                                    </select>
                                                                    <a style="cursor: pointer;" data-toggle="modal" data-target="#createreference">
                                                                        <i class="fa fa-plus"></i>
                                                                        &nbsp; Ajouter Référence 
                                                                    </a>
                                                                </div>                               
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Unité</label>
                                                                    <select class="form-control" name="d2[{{$key2}}][unite]"  >
                                                                        @foreach($unites2 as $unite2)
                                                                        <option @if($unite2->nom == $row2->unite) selected @endif value="{{$unite2->nom}}">{{$unite2->nom}}</option>						 
                                                                        @endforeach
                                                                    </select>
                                                                    <a style="cursor: pointer;" data-toggle="modal" data-target="#createunite">
                                                                        <i class="fa fa-plus"></i>
                                                                        &nbsp; Ajouter Unité 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label for="">Norme</label>
                                                                    <!-- <select class="form-control" name="d2[{{$key2}}][norme]" id="select_norme">
                                                                        @foreach($normes2 as $norme2)
                                                                        <option @if($norme2->valeur == $row2->norme) selected @endif value="{{$norme2->valeur}}">{{$norme2->valeur ?? ""}}</option>						 
                                                                        @endforeach
                                                                    </select>
                                                                    <a data-toggle="modal" style="cursor: pointer;" data-target="#createnorme">
                                                                        <i class="fa fa-plus"></i>
                                                                        Ajouter Norme
                                                                    </a> -->
                                                                    <input type="text" value="{{$row2->norme2 ?? '' }}" name="norme1" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                @endforeach





                                                <div class="form-group" id="dynamic_form_second">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Paramètre</label>
                                                                    <select id="select_setting2" class="form-control settings2"  name="setting2">
                                                                        <option value="">Séléctionner</option>						 
                                                                        @foreach($settings2 as $setting2)
                                                                            <option value="{{$setting2->determination}}" id="{{$setting2->id}}">{{$setting2->determination}}</option>						 
                                                                        @endforeach
                                                                    </select>
                                                                    <a style="cursor: pointer;" data-toggle="modal" data-target="#createsetting">
                                                                        <i class="fa fa-plus"></i>
                                                                        &nbsp; Ajouter Paramètre 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Référence</label>
                                                                    <select class="form-control _references2"  name="_reference2" id="select_reference2">
                                                                        <option value="">Séléctionner</option>						 

                                                                        @foreach($references2 as $reference2)
                                                                        <option value="{{$reference2->determination}}">{{$reference2->determination}}</option>						 
                                                                        @endforeach
                                                                    </select>
                                                                    <a style="cursor: pointer;" data-toggle="modal" data-target="#createreference">
                                                                        <i class="fa fa-plus"></i>
                                                                        &nbsp; Ajouter Référence 
                                                                    </a>
                                                                </div>                               
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Unité</label>
                                                                    <select class="form-control unites2"  name="unite2" id="select_unite2">
                                                                        <option value="">Séléctionner</option>						 

                                                                        @foreach($unites2 as $unite2)
                                                                        <option value="{{$unite2->nom}}">{{$unite2->nom}}</option>						 
                                                                        @endforeach
                                                                    </select>
                                                                    <a style="cursor: pointer;" data-toggle="modal" data-target="#createunite">
                                                                        <i class="fa fa-plus"></i>
                                                                        &nbsp; Ajouter Unité 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label for="">Norme</label>
                                                                    <select class="form-control normes2" name="norme2" id="select_norme2">
                                                                        <option value="">Séléctionner</option>						 

                                                                        @foreach($normes2 as $norme2)
                                                                        <option value="{{$norme2->valeur}}">{{$norme2->valeur ?? ""}}</option>						 
                                                                        @endforeach
                                                                    </select>
                                                                    <a data-toggle="modal" style="cursor: pointer;" data-target="#createnorme">
                                                                        <i class="fa fa-plus"></i>
                                                                        Ajouter Norme
                                                                    </a>

                                                                </div>

                                                            </div>
                                                            <div class="button-group">
                                                                <label>Action</label><br>
                                                                <a href="javascript:void(0)" class="btn btn-primary" id="plus5_second"><i class="fa fa-plus"></i></a>
                                                                <a href="javascript:void(0)" class="btn btn-danger" id="minus5_second"><i class="fa fa-minus"></i></a>
                                                            </div>
                                                        </div> 
                                                </div>









                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="">Aspect & couleur</label>
                                                                <select class="form-control"  name="aspect_couleurs">
                                                                    @foreach($aspect_couleurs as $aspect_couleur)
                                                                    <option 
                                                                    @if($aspect_couleur->value == $produit->aspect_couleurs) selected @endif
                                                                    value="{{$aspect_couleur->value ?? ''}}">{{$aspect_couleur->value}}</option>						 
                                                                    @endforeach
                                                                </select>
                                                                <a style="cursor: pointer;" data-toggle="modal" data-target="#createorgano">
                                                                    <i class="fa fa-plus"></i>
                                                                    &nbsp; Ajouter aspect_couleurs 
                                                                </a>
                                                                
                                                            </div>
                                                        </div> 
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="">Gout & Odeur</label>
                                                                <select class="form-control"  name="gout_odeurs">
                                                                    @foreach($gout_odeurs as $gout_odeur)
                                                                    <option @if($gout_odeur->value == $produit->gout_odeurs) selected @endif value="{{$gout_odeur->value ?? ''}}">{{$gout_odeur->value}}</option>						 
                                                                    @endforeach
                                                                </select>
                                                                <a style="cursor: pointer;" data-toggle="modal" data-target="#createorgano">
                                                                    <i class="fa fa-plus"></i>
                                                                    &nbsp; Ajouter gout_odeurs 
                                                                </a>
                                                            </div>
                                                        </div> 
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="">Examen Macroscopique</label>
                                                                <select class="form-control"  name="examen_macroscopiques">
                                                                    @foreach($examen_macroscopiques as $examen_macroscopique)
                                                                    <option value="{{$examen_macroscopique->value ?? ''}}"
                                                                    @if($examen_macroscopique->value == $produit->examen_macroscopiques) selected @endif
                                                                    
                                                                    >{{$examen_macroscopique->value}}</option>						 
                                                                    @endforeach
                                                                </select>
                                                                <a style="cursor: pointer;" data-toggle="modal" data-target="#createorgano">
                                                                    <i class="fa fa-plus"></i>
                                                                    &nbsp; Ajouter examen_macroscopiques 
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <label for="">Conclusion / Confirmité   :</label>
                                                                <textarea class="form-control" name="conformite">
                                                                        {{$produit->conformite ?? ''}}
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    <br>

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <button type="submit" id="valider" class="btn btn-info btn-block">Valider</button>
                                                        </div>
                                                    </div>



                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach(['setting','reference','unite','norme','organo'] as $item)
                        <div class="modal fade" id="create{{$item}}" tabindex="-1" role="dialog" aria-labelledby="create{{$item}}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="create{{$item}}Label">Ajouter {{$item}}: </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route($item.'.create')}}" class="form_create" method="post" enctype="multipart/form-data" id="_{{$item}}">
                                    @csrf
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputFirstName">{{$item}}: </label>
                                            @if($item == "setting")
                                                <input type="text" name="determination" value="" id="input_{{$item}}"  class="form-control"/>
                                                <input type="hidden" name="type" value="{{$type}}"  class="form-control"/>
                                            @endif
                                            @if($item == "reference")
                                                <input type="text" name="determination" value=""  class="form-control"/>
                                            @endif
                                            @if($item == "unite")
                                                <input type="text" name="nom" value=""  class="form-control" />
                                            @endif
                                            @if($item == "norme")
                                                <input type="text" name="valeur" value=""  class="form-control" id="input_{{$item}}"/>
                                            @endif
                                            @if($item == "organo")
                                                <div class="form-group">
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
                                            @endif


                                        </div>    
                                        <button class="btn btn-primary btn-block btnSend" type="submit" id="ajax_{{$item}}">Envoyer</button>
                                    </form>                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>                    
                    @endforeach
                    <!-- 
                        Paramètre
                     -->

                    <!-- 
                        Référence
                     -->



@endsection


@section('scripts')
<script>
$(document).ready(function() {
    // $('.form_create').submit(function(e){
    //     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    //     e.preventDefault()
    //     var id = this.id
    //     var idWithout_ = id.substring(1); 
    //     var value= $('#input'+id).val();
    //     console.log(value)
    //     console.log('input'+id)
    //     $.ajax({
    //         url: this.action,
    //         type: 'POST',
    //         data: {_token: CSRF_TOKEN, value:value},
    //         dataType: 'JSON',
    //         success: function (data) { 
    //             console.log("create"+idWithout_)
    //             $("#select"+id+'0').append(new Option(value, value));                
    //             $("#create"+idWithout_).modal('hide');
    //             toastr.success('Element inséré')
    //         },
    //         error:function(err){
    //             toastr.error('Erreur Pendant l\'insertion')
    //             console.log(err)
    //         }
    //     });

    // })

    $('.js-example-basic-multiple').select2();




    var settings1  = {!! json_encode($settings1->toArray()) !!};
    var settings2  = {!! json_encode($settings2->toArray()) !!};

    
    $('.settings1').on('change',function(){
        var valueSelected = this.id;
        var value = this.value
        var l = valueSelected.length
        var index  = valueSelected[l-1];
        const found = settings1.find(element => element.determination == value);

        console.log( valueSelected ,found)
        $("#select_reference1"+index).append(('<option value="'+found.reference+'" selected="selected">'+found.reference+'</option>'));
        $("#select_norme1"+index).append(('<option value="'+found.norme+'" selected="selected">'+found.norme+'</option>'));
        $("#select_unite1"+index).append(('<option value="'+found.unite+'" selected="selected">'+found.unite+'</option>'));


    })



    $('.settings2').on('change',function(){
        var valueSelected = this.id;
        var value = this.value
        var l = valueSelected.length
        var index  = valueSelected[l-1];
        const found = settings2.find(element => element.determination == value);
        console.log( valueSelected ,found)

        $("#select_reference2"+index).append(('<option value="'+found.reference+'" selected="selected">'+found.reference+'</option>'));
        $("#select_norme2"+index).append(('<option value="'+found.norme+'" selected="selected">'+found.norme+'</option>'));
        $("#select_unite2"+index).append(('<option value="'+found.unite+'" selected="selected">'+found.unite+'</option>'));


    })




    var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus5", "#minus5", {
        limit:10,
        formPrefix : "dynamic_form",
        normalizeFullForm : false
    });
    
    var dynamic_form_second =  $("#dynamic_form_second").dynamicForm("#dynamic_form_second","#plus5_second", "#minus5_second", {
        limit:10,
        formPrefix : "dynamic_form_second",
        normalizeFullForm : false
    });

    $("#dynamic_form #minus5").on('click', function(){
        var initDynamicId = $(this).closest('#dynamic_form').parent().find("[id^='dynamic_form']").length;
        if (initDynamicId === 2) {
            $(this).closest('#dynamic_form').next().find('#minus5').hide();
        }
        $(this).closest('#dynamic_form').remove();
    });

    $("#dynamic_form_second #minus5_second").on('click', function(){
        var initDynamicId = $(this).closest('#dynamic_form_second').parent().find("[id^='dynamic_form_second']").length;
        if (initDynamicId === 2) {
            $(this).closest('#dynamic_form_second').next().find('#minus5_second').hide();
        }
        $(this).closest('#dynamic_form_second').remove();
    });

    $('#global').on('submit', function(event){
        var values = {};
        $.each($('form').serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        console.log(values)
    })

    



});

</script>
@endsection


