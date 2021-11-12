@extends('layouts.master')

@section('page_wrapper')
@endsection

@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mt-2"> 
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Modifier Analyse  </h3></div>
                                    <div class="card-body">
                                        <div class="leftSide"><!-- Begin of content -->
                                            <form action="{{route('analyse.update',['analyse'=>$analyse->id])}}" method="post">
                                            @csrf
                                            <!-- 
                                                hidden variables
                                             -->
                                            <input type="hidden" id="produits" value="{{$produits}}" />
                                                <div class="container-fluid">


                                                <div class="well">
                                                        <div class="row">
                                                            <div class="col-sm-3">         
                                                                <div class="form-group">
                                                                    <label>Type D'analyse</label>

                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="type_analyse_1" id="defaultCheck1" 
                                                                        @if($analyse->type_analyse_1 == 1)
                                                                            checked
                                                                        @endif
                                                                        >
                                                                        <label class="form-check-label" for="defaultCheck1">
                                                                        Analyse Physico-chimique
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="type_analyse_2" id="defaultCheck2"
                                                                        @if($analyse->type_analyse_2 == 1)
                                                                            checked
                                                                        @endif
                                                                        
                                                                        >
                                                                        <label class="form-check-label" for="defaultCheck2">
                                                                        Analyse Micro-biologique
                                                                        </label>
                                                                            
                                                                    </div>



                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="">Categorie </label>
                                                                    <select class="form-control "  value="{{$analyse->categorie ?? ''}}" name="categorie">
                                                                        @foreach($categories as $categorie)
                                                                        <option value="{{$categorie->id}}" @if($analyse->categorie == $categorie->id) selected @endif>{{$categorie->label}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                <label for="">Nature du Produit:</label>
                                                                    <select class="form-control produits" id="produit" value="{{$analyse->produit ?? ''}}" name="produit">
                                                                        <option value="">séléctionner Produit</option>
                                                                        @foreach($produits as $produit)
                                                                            <option @if($produit->id == $produit_id) selected @endif value="{{$produit->id}}">{{$produit->designation}}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="">Nom Commercial</label>
                                                                    <input type="text" class="form-control" id="marque" value="{{$analyse->marque ?? ''}}" name="marque">
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div>


                                                <div class="well sm">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                <label for="">Client :</label>
                                                                    <select class="form-control "  value="{{$analyse->client ?? ''}}" name="client">
                                                                    <option value="" >séléctionner client</option>
                                                                        @foreach($clients as $client)
                                                                            <option
                                                                            value="{{$client->id}}"
                                                                            @if($analyse->client ==$client->id) selected @endif
                                                                            >{{$client->nom}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">&nbsp;</label>
                                                                    <select value="{{$analyse->type ?? ''}}" name="type" id="faitpar" class="form-control">
                                                                        <option value="1"> fait par les soins du laboratoire </option>
                                                                        <option value="0"> fait par les soins du propriétaire </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">         
                                                                <div class="form-group">
                                                                    <label>Le :</label>
                                                                    <input type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31"  value="{{$analyse->prelevement ?? ''}}" name="prelevement" id="prelevement" class="form-control mesdates">
                                                                </div>
                                                            </div>

                                                            <!-- <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="">Code barre</label>
                                                                    <input type="text" class="form-control" id="code_barre" value="{{$analyse->code_barre ?? ''}}" name="code_barre">
                                                                </div>
                                                            </div>  -->
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <table class="table results"></table>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="well autres hidden">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="">Autres Produits :</label>
                                                                    <input type="text" value="{{$analyse->nomproduit ?? ''}}" name="nomproduit" id="produit" value="" autocomplete="off" placeholder="tapez une famille" class="form-control">
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
                                                                    <select class="form-control" id="contenance" value="{{$analyse->contenance ?? ''}}" name="contenance">
                                                                        <option value="Poids">Poids</option>
                                                                        <option value="Volume">Volume</option>
                                                                    </select>
                                                                </div>
                                                            </div> 

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="">Valeur</label>
                                                                    <input type="text" class="form-control" id="valeur" value="{{$analyse->valeur ?? ''}}" name="valeur">
                                                                </div>
                                                            </div> 
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="">Quantité : </label>
                                                                    <input type="text" class="form-control" id="quantite" value="{{$analyse->quantite ?? ''}}" name="quantite">
                                                                </div>
                                                            </div> 


                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>Date de fabrication</label>
                                                                    <input type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" value="{{$analyse->fabrication ?? ''}}" name="fabrication" id="fabrication" class="form-control mesdates">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">        
                                                                <div class="form-group ">
                                                                    <label>Date de peremption</label>
                                                                    <input type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" value="{{$analyse->peremption ?? ''}}" name="peremption" id="peremption" class="form-control mesdates">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>N° lot</label>
                                                                    <input type="text" value="{{$analyse->lot ?? ''}}" name="lot" id="lot" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Heure</label>
                                                                    <input type="text" value="{{$analyse->heure ?? ''}}" name="heure" id="heure" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>Date d'analyse </label>
                                                                    <input type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" value="{{$analyse->data_analyse ?? ''}}" name="data_analyse" id="data_analyse" class="form-control mesdates">
                                                                </div>
                                                            </div> 

                                                            <div class="col-sm-3">         
                                                                <div class="form-group">
                                                                    <label>Date Impression</label>
                                                                    <input type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31"  value="{{$analyse->date_impression ?? ''}}" name="date_impression" id="prelevement" class="form-control mesdates">
                                                                </div>
                                                            </div>



                                                        </div>
                                                    </div>
                                                    <div class="well">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label>Opérateur Physico-chimie : </label>
                                                                <select class="form-control" id="op1" value="{{$analyse->operateur1 ?? ''}}" name="operateur1">
                                                                    @foreach($operateurs as $operateur)
                                                                    <option value="{{$operateur->id}}">{{$operateur->nom}}</option>
                                                                    @endforeach
                                                                </select>             
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label>Opérateur Microbio :  </label>
                                                                <select class="form-control" id="op2" value="{{$analyse->operateur2 ?? ''}}" name="operateur2">
                                                                    @foreach($operateurs as $operateur)
                                                                    <option value="{{$operateur->id}}">{{$operateur->nom}}</option>
                                                                    @endforeach
                                                                </select>             
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="well">




                                                                <hr>
                                                        <br>

                                                        <div class="row text-center">
                                                            <h3 class="text-center">
                                                            Examen préliminaire
                                                            </h3>
                                                        </div>
                                                        <br>


                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="">Aspect & couleur</label>
                                                                    <input type="text" name="aspect_couleurs" value="{{$produit->aspect_couleurs ?? ''}}" class="form-control">

                                                                </div>
                                                            </div> 
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">Gout & Odeur</label>
                                                                    <input type="text" name="gout_odeurs" value="{{$produit->gout_odeurs ?? ''}}" class="form-control">
                                                                    <!-- <select class="form-control" name="gout_odeur">
                                                                        <option value="">Séléctionner</option>						 
                                                                        @foreach($gout_odeurs as $gout_odeur)
                                                                        <option value="{{$gout_odeur->value}}">{{$gout_odeur->value}}</option>						 
                                                                        @endforeach
                                                                    </select> -->
                                                                </div>
                                                            </div> 
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">Examen Macroscopique</label>
                                                                    <input type="text" name="examen_macroscopiques" value="{{$produit->examen_macroscopiques ?? ''}}" class="form-control" >

                                                                    <!-- <select class="form-control" name="examen_macroscopique">
                                                                        <option value="">Séléctionner</option>						 
                                                                        @foreach($examen_macroscopiques as $examen_macroscopique)
                                                                        <option value="{{$examen_macroscopique->value}}">{{$examen_macroscopique->value}}</option>						 
                                                                        @endforeach
                                                                    </select> -->

                                                                </div>
                                                            </div> 
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <p></p>
                                                                <button type="submit" id="valider" class="btn btn-info btn-block">Valider</button>
                                                            </div>
                                                        </div>                                                    


                                                        <div class="row">
                                                            <!-- <div class="col-sm-6">
                                                                <select class="form-control" id="op1" value="{{$analyse->operateur1 ?? ''}}" name="operateur1">
                                                                    @foreach($operateurs1 as $operateur1)
                                                                        <option value="{{$operateur1->id}}">{{$operateur1->nom}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> -->

                                                        </div>
                                                        
                                                        <hr>

                                                        <div class="row text-center">
                                                            <h3 class="text-center">
                                                            En Tete * : 
                                                            <h3>
                                                        </div>
                                                        <br>

                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control" value="{{$header->header1 ?? ''}}" name="header1" id="header1" value="Paramètre" placeholder="resultat" >
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control" value="{{$header->header2 ?? ''}}" name="header2" id="header2" value="Unite" >
                                                            </div>
                                                            <div class="col-md-1">
                                                                <input type="text" class="form-control" value="{{$header->header3 ?? ''}}" name="header3" id="header3"  value="" >
                                                            </div>

                                                            <div class="col-md-1 extra">    
                                                                <input type="text" class="form-control" value="{{$header->header4 ?? ''}}" name="header4" id="header4"  value="" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                <input type="text" class="form-control" value="{{$header->header5 ?? ''}}" name="header5" id="header5"  value="" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                <input type="text" class="form-control" value="{{$header->header6 ?? ''}}" name="header6" id="header6"  value="" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                <input type="text" class="form-control" value="{{$header->header7 ?? ''}}" name="header7" id="header7"  value="" >
                                                            </div>
                                                            <div class="col-md-1">
                                                                <input type="text" class="form-control" value="{{$header->header8 ?? ''}}" name="header8" id="header8"  value="norme" >
                                                            </div>

                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control" value="{{$header->header9 ?? ''}}" name="header9" id="header9"  value="Référecne" >
                                                            </div>
                                                        </div>



                                                        <br>

                                                        <div class="row text-center">
                                                            <h3 class="text-center">
                                                            Résultats : 
                                                            <h3>
                                                        </div>
                                                        <br>
                                                        <label>
                                                            Bulletin d'analyse 
                                                            Physico-chimique
                                                        </label>
                                                        <br>
                                                    </div>





                                                    <br>

                                                    @foreach($elements as $key=>$element)
                                                    <input value="{{$element->id}}" name="d[{{$key}}][id]" type="hidden" />
                                                    <div class="form-group" id="">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <label>Paramètre</label>
                                                                <select class="form-control" id="parametre" name="d[{{$key}}][parametre]">
                                                                    @foreach($settings as $setting)
                                                                        <option value="{{$setting}}">
                                                                            {{$setting ?? 'sa'}}
                                                                        </option>
                                                                    @endforeach                                                                    
                                                                </select>

                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Unité</label>
                                                                    <select class="form-control"  id="unite" name="d[{{$key}}][unite]">
                                                                    @foreach($unites as $unite)
                                                                        <option value="{{$unite}}">
                                                                            {{$unite ?? 'sa'}}
                                                                        </option>
                                                                    @endforeach

                                                                    </select>                                                                    
                                                            </div>


                                                            <div class="col-md-1">
                                                                <label>
                                                                    Résultat
                                                                </label>
                                                                <input type="text" class="form-control" value="{{$element->resultat ?? ''}}" name="d[{{$key}}][resultat]" id="resultat" placeholder="resultat" >
                                                            </div>


                                                            <div class="col-md-1 extra">    
                                                                    <label>
                                                                        Resultat
                                                                    </label>
                                                                    <input type="text" class="form-control" value="{{$element->resultat1 ?? ''}}" name="d[{{$key}}][resultat1]" id="resultat_second" placeholder="resultat" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                    <label>
                                                                        Resultat
                                                                    </label>
                                                                    <input type="text" class="form-control" value="{{$element->resultat2 ?? ''}}" name="d[{{$key}}][resultat2]" id="resultat_second" placeholder="resultat" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                    <label>
                                                                        Resultat
                                                                    </label>
                                                                    <input type="text" class="form-control" value="{{$element->resultat3 ?? ''}}" name="d[{{$key}}][resultat3]" id="resultat_second" placeholder="resultat" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                    <label>
                                                                        Resultat
                                                                    </label>
                                                                    <input type="text" class="form-control" value="{{$element->resultat4 ?? ''}}" name="d[{{$key}}][resultat4]" id="resultat_second" placeholder="resultat" >
                                                            </div>

                                                            <div class="col-md-1">
                                                                <label>
                                                                    Norme
                                                                </label>
                                                                <select class="form-control" id="norme" name="d[{{$key}}][norme]">
                                                                    @foreach($normes as $norme)
                                                                        <option value="{{$norme}}">
                                                                            {{$norme ?? 'sa'}}
                                                                        </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label>Référence</label>
                                                                <select class="form-control" id="reference" name="d[{{$key}}][reference]">
                                                                    @foreach($references as $reference)
                                                                        <option value="{{$reference}}" @if($reference == $element->reference) selected @endif>
                                                                            {{$reference ?? 'sa'}}
                                                                        </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                    @endforeach










                                                    <div class="row">
                                                            <div class="col-sm-8">
                                                                <label for="">Conclusion / Confirmité (Physico):</label>
                                                                <textarea class="form-control" name="conformite1">
                                                                    {{$analyse->conformite1}}
                                                                </textarea>
                                                            </div>
                                                        </div>


                                                    <hr>
                                                    <br>
                                                    <br>
                                                    <br>

                                                    <label>
                                                            Bulletin d'analyse Micro-biologique
                                                        </label>
                                                    <hr>

                                                    <div class="row">

                                                            <input type="hidden" class="form-control" value="{{$header2->id ?? ''}}" name="id_header2"  >
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control" value="{{$header2->header1 ?? ''}}" name="header_1"  value="Paramètre" placeholder="resultat" >
                                                            </div>
                                                            <div class="col-md-1">
                                                                <input type="text" class="form-control" value="{{$header2->header2 ?? ''}}" name="header_2" id="header2" value="Unite" >
                                                            </div>
                                                            <div class="col-md-1">
                                                                <input type="text" class="form-control" value="{{$header2->header3 ?? ''}}" name="header_3" id="header3"  value="" >
                                                            </div>

                                                            <div class="col-md-1">
                                                                <input type="text" class="form-control" value="{{$header2->header9 ?? ''}}" name="header_9" id="header9"  value="" >
                                                            </div>

                                                            <div class="col-md-1 extra">    
                                                                <input type="text" class="form-control" value="{{$header2->header4 ?? ''}}" name="header_4" id="header4"  value="" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                <input type="text" class="form-control" value="{{$header2->header5 ?? ''}}" name="header_5" id="header5"  value="" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                <input type="text" class="form-control" value="{{$header2->header6 ?? ''}}" name="header_6" id="header6"  value="" >
                                                            </div>

                                                            <div class="col-md-1">
                                                                <input type="text" class="form-control" value="{{$header2->header7 ?? ''}}" name="header_7" id="header7"  value="" >
                                                            </div>

                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control" value="{{$header2->header8 ?? ''}}" name="header_8" id="header8"  value="" >

                                                            </div>

                                                        </div>

                                                    
                                                    

                                                    
                                                    @forelse($elements2 as $key=>$element2)
                                                    <input value="{{$element2->id}}" name="d2[{{$key}}][id]" type="hidden" />
                                                    <div class="form-group" id="">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <label>Paramètre</label>
                                                                <select class="form-control" id="parametre" name="d2[{{$key}}][parametre]">
                                                                    @foreach($settings as $setting)
                                                                        <option value="{{$setting}}" @if($setting == $element2->parametre) selected @endif>
                                                                            {{$setting ?? 'sa'}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                            <div class="col-md-1">
                                                                <label>Unité</label>
                                                                    <select class="form-control"  id="unite" name="d2[{{$key}}][unite]">
                                                                    @foreach($unites as $unite)
                                                                        <option value="{{$unite}}">
                                                                            {{$unite ?? 'sa'}}
                                                                        </option>
                                                                    @endforeach

                                                                    </select>                                                                    
                                                            </div>


                                                            <div class="col-md-1">
                                                                <label>
                                                                    Résultat
                                                                </label>
                                                                <input type="text" class="form-control" value="{{$element2->resultat ?? ''}}" name="d2[{{$key}}][resultat]" id="resultat" placeholder="resultat" >
                                                            </div>


                                                            <div class="col-md-1 extra">    
                                                                    <label>
                                                                        Resultat
                                                                    </label>
                                                                    <input type="text" class="form-control" value="{{$element2->resultat1 ?? ''}}" name="d2[{{$key}}][resultat1]" id="resultat_second" placeholder="resultat" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                    <label>
                                                                        Resultat
                                                                    </label>
                                                                    <input type="text" class="form-control" value="{{$element2->resultat2 ?? ''}}" name="d2[{{$key}}][resultat2]" id="resultat_second" placeholder="resultat" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                    <label>
                                                                        Resultat
                                                                    </label>
                                                                    <input type="text" class="form-control" value="{{$element2->resultat3 ?? ''}}" name="d2[{{$key}}][resultat3]" id="resultat_second" placeholder="resultat" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                    <label>
                                                                        Resultat
                                                                    </label>
                                                                    <input type="text" class="form-control" value="{{$element2->resultat4 ?? ''}}" name="d2[{{$key}}][resultat4]" id="resultat_second" placeholder="resultat" >
                                                            </div>

                                                            <div class="col-md-1">
                                                                <label>
                                                                    Norme
                                                                </label>
                                                                <select class="form-control" id="norme" name="d2[{{$key}}][norme]">
                                                                    @foreach($normes as $norme)
                                                                        <option value="{{$norme}}">
                                                                            {{$norme ?? 'sa'}}
                                                                        </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label>Référence</label>
                                                                <select class="form-control" id="reference" name="d2[{{$key}}][reference]">
                                                                    @foreach($references as $reference)
                                                                        <option value="{{$reference}}" @if($reference == $element->reference) selected @endif>
                                                                            {{$reference ?? 'sa'}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>                                                           
                                                        </div>
                                                    </div>
                                                    @empty
                                                        @foreach($rows2 as $key=>$row2)
                                                            <input value="{{$row2->id}}" name="d2[{{$key}}][id]" type="hidden" />
                                                            <div class="form-group" >
                                                                        <div class="row">
                                                                            <div class="col-md-2">
                                                                                <select class="form-control" id="parametre" name="d2[{{$key}}][parametre]">
                                                                                    @foreach($settings as $setting)
                                                                                        <option value="{{$setting}}" @if($setting == $row2->setting) selected @endif>
                                                                                            {{$setting ?? 'sa'}}
                                                                                        </option>
                                                                                    @endforeach 
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                    <select class="form-control"  id="unite"  name="d2[{{$key}}][unite]">
                                                                                    @foreach($unites as $unite)
                                                                                        <option value="{{$unite}}" @if($unite == $row2->unite) selected @endif>
                                                                                            {{$unite ?? 'sa'}}
                                                                                        </option>
                                                                                    @endforeach

                                                                                    </select>                                                                    
                                                                            </div>


                                                                            <div class="col-md-1">
                                                                                <input type="text" class="form-control" placeholder="resultat" name="d2[{{$key}}][resultat]" >
                                                                            </div>
                                                                            
                                                                            <div class="col-md-1 extra">    
                                                                                    <input type="text" class="form-control" name="d2[{{$key}}][resultat1]" placeholder="resultat" >
                                                                            </div>
                                                                            <div class="col-md-1 extra">
                                                                                    <input type="text" class="form-control" name="d2[{{$key}}][resultat2]" placeholder="resultat" >
                                                                            </div>
                                                                            <div class="col-md-1 extra">
                                                                                    <input type="text" class="form-control" name="d2[{{$key}}][resultat3]" placeholder="resultat" >
                                                                            </div>
                                                                            <div class="col-md-1 extra">
                                                                                    <input type="text" class="form-control" name="d2[{{$key}}][resultat4]" placeholder="resultat" >
                                                                            </div>

                                                                            <div class="col-md-1">
                                                                                <select class="form-control" id="norme" name="d2[{{$key}}][norme]">
                                                                                    @foreach($normes as $norme)
                                                                                        <option value="{{$norme}}" @if($norme == $row2->norme) selected @endif>
                                                                                            {{$norme ?? 'sa'}}
                                                                                        </option>
                                                                                    @endforeach

                                                                                </select>
                                                                            </div>

                                                                            <div class="col-md-2">
                                                                                <select class="form-control" id="reference" name="d2[{{$key}}][reference]">
                                                                                    @foreach($references as $reference)
                                                                                        <option value="{{$reference}}" @if($reference == $row2->reference) selected @endif>
                                                                                            {{$reference ?? 'sa'}}
                                                                                        </option>
                                                                                    @endforeach

                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                        @endforeach

                                                    
                                                    
                                                    @endforelse





                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                                <label for="">Durée (par heure ):</label>
                                                            <input type="text" class="form-control" name="duree" id="duree" placeholder="duree" >
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <label for="">Conclusion / Confirmité :</label>
                                                            <textarea class="form-control" name="conformite2">
                                                            {{$analyse->conformite2}}
                                                            </textarea>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <p></p>
                                                            <button type="submit" id="valider" class="btn btn-info btn-block">Valider</button>
                                                        </div>
                                                    </div>                                                    
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

    $('.js-example-basic-multiple').select2();



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

    $('form').on('submit', function(event){
        var values = {};
        $.each($('form').serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        console.log(values)
    })

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    $('#defaultCheck1').change(function(){
        console.log(this.value)
    })

    $('#defaultCheck2').change(function(){
        console.log(this.value)
    })

    $('input[type=radio][name=type_analyse]').change(function() {
        if (this.value == 0) {
            $('.extra').show(1000);
        }
        else if (this.value == 1) {
            $('.extra').hide(1000);
        }
    });




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