@extends('layouts.master')

@section('page_wrapper')
@endsection

@section('content')

                <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouveau Analyse  </h3></div>
                                    <div class="card-body">
                                        <div class="leftSide"><!-- Begin of content -->
                                            <form action="{{route('analyse.store')}}" method="post">
                                            @csrf
                                            <!-- 
                                                hidden variables
                                             -->
                                            <input type="hidden" id="produits" value="{{$produits}}" />
                                                <div class="container-fluid">


                                                <div class="well">
                                                        <div class="row">


                                                            <div class="col-sm-3">         
                                                            <label>Avec Numéro d'inscruiption :</label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"  id="flexRadioDefault1" name="inscrit" checked>
                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                        Oui
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"  id="flexRadioDefault2" name="inscrit" >
                                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                                        Non
                                                                    </label>
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-3">         
                                                                <div class="form-group">
                                                                    <label>Type D'analyse</label>

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
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                <label for="">Nature du Produit:</label>
                                                                    <select class="form-control produits" id="produit" value="{{old('produit')}}" name="produit">
                                                                        <option value="">séléctionner Produit</option>
                                                                        @foreach($produits as $produit2)
                                                                            <option @if($produit2->id == $produit_id) selected @endif value="{{$produit2->id}}">{{$produit2->designation}}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="">Categorie </label>
                                                                    <select class="form-control categories"  value="{{old('categorie')}}" name="categorie">
                                                                        @foreach($categories as $categorie)
                                                                            <option value="{{$categorie->id}}" @if($produit->categorie == $categorie->id) selected @endif>{{$categorie->label}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
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
                                                                <label for="">Client :</label>
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
                                                                    <label for="">Quantité : </label>
                                                                    <input type="text" class="form-control" id="quantite" value="{{old('quantite')}}" name="quantite">
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
                                                                    <label>Date de peremption</label>
                                                                    <input type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" value="{{old('peremption')}}" name="peremption" id="peremption" class="form-control mesdates">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>N° lot</label>
                                                                    <input type="text" value="{{old('lot')}}" name="lot" id="lot" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Heure</label>
                                                                    <input type="text" value="{{old('heure')}}" name="heure" id="heure" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>Date d'analyse </label>
                                                                    <input type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" value="{{old('data_analyse')}}" name="data_analyse" id="data_analyse" class="form-control mesdates">
                                                                </div>
                                                            </div> 

                                                            <!-- <div class="col-sm-3">         
                                                                <div class="form-group">
                                                                    <label>Date Impression</label>
                                                                    <input type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31"  value="{{old('date_impression')}}" name="date_impression" id="prelevement" class="form-control mesdates">
                                                                </div>
                                                            </div> -->



                                                        </div>
                                                    </div>
                                                    <div class="well">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label>Opérateur Physico-chimie : </label>
                                                                <select class="form-control" id="op1" value="{{old('operateur1')}}" name="operateur1">
                                                                    @foreach($operateurs1 as $operateur1)
                                                                    <option value="{{$operateur1->id}}">{{$operateur1->nom}}</option>
                                                                    @endforeach
                                                                </select>             
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label>Opérateur Microbio :  </label>
                                                                <select class="form-control" id="op2" value="{{old('operateur2')}}" name="operateur2">
                                                                    @foreach($operateurs2 as $operateur2)
                                                                    <option value="{{$operateur2->id}}">{{$operateur2->nom}}</option>
                                                                    @endforeach
                                                                </select>             
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="well">
                                                                <div class="row">
                                                                </div>
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

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">
                                                                        Nouveau Champ
                                                                    </label>
                                                                    <input type="text" name="champ"  class="form-control" >
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
                                                                <select class="form-control" id="op1" value="{{old('operateur1')}}" name="operateur1">
                                                                    @foreach($operateurs1 as $operateur1)
                                                                        <option value="{{$operateur1->id}}">{{$operateur1->nom}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> -->

                                                        </div>
                                                        
                                                        <hr>
                                                        <br>

                                                        <div class="row text-center">
                                                            <h3 class="text-center">
                                                            En Tete : 
                                                            <h3>
                                                        </div>
                                                        <br>



                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control" name="header1" id="header1" value="Paramètre" placeholder="resultat" >
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control" name="header2" id="header2" value="Unite" >
                                                            </div>
                                                            <div class="col-md-1">
                                                                <input type="text" class="form-control" name="header3" id="header3"  value="" >
                                                            </div>

                                                            <div class="col-md-1 extra">    
                                                                <input type="text" class="form-control" name="header4" id="header4"  value="" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                <input type="text" class="form-control" name="header5" id="header5"  value="" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                <input type="text" class="form-control" name="header6" id="header6"  value="" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                <input type="text" class="form-control" name="header7" id="header7"  value="" >
                                                            </div>

                                                            <div class="col-md-1">
                                                                <input type="text" class="form-control" name="header8" id="header8"  value="norme" >
                                                            </div>

                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control" name="header9" id="header9"  value="Référence" >
                                                            </div>
                                                        </div>

                                                        <br>


                                                        <h3 class="text text-primary">
                                                            Bulletin d'analyse 
                                                            Physico-chimique
                                                        </h3>
                                                    </div>





                                                    <br>


                                                        @foreach($rows1 as $key=>$row1)
                                                            <div class="form-group" >
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <select class="form-control" id="parametre" name="d[{{$key}}][parametre]">
                                                                            @foreach($settings as $setting)
                                                                                <option value="{{$setting}}" @if($setting == $row1->setting) selected @endif>
                                                                                    {{$setting ?? 'sa'}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>
                                                                    <div class="col-md-2">
                                                                            <select class="form-control"  id="unite" name="d[{{$key}}][unite]">
                                                                            @foreach($unites as $unite)
                                                                                <option value="{{$unite}}" @if($unite == $row1->unite) selected @endif>
                                                                                    {{$unite ?? 'sa'}}
                                                                                </option>
                                                                            @endforeach

                                                                            </select>                                                                    
                                                                    </div>


                                                                    <div class="col-md-1">
                                                                        <input type="text" class="form-control" placeholder="resultat" name="d[{{$key}}][resultat]" >
                                                                    </div>
                                                                    <div class="col-md-1 extra">    
                                                                            <input type="text" class="form-control" name="d[{{$key}}][resultat1]" placeholder="resultat" >
                                                                    </div>
                                                                    <div class="col-md-1 extra">
                                                                            <input type="text" class="form-control" name="d[{{$key}}][resultat2]" placeholder="resultat" >
                                                                    </div>
                                                                    <div class="col-md-1 extra">
                                                                            <input type="text" class="form-control" name="d[{{$key}}][resultat3]" placeholder="resultat" >
                                                                    </div>
                                                                    <div class="col-md-1 extra">
                                                                            <input type="text" class="form-control" name="d[{{$key}}][resultat4]" placeholder="resultat" >
                                                                    </div>

                                                                    <div class="col-md-1">
                                                                        <select class="form-control" id="norme"  name="d[{{$key}}][norme]">
                                                                            @foreach($normes as $norme)
                                                                                <option value="{{$norme}}" @if($norme == $row1->norme) selected @endif>
                                                                                    {{$norme ?? 'sa'}}
                                                                                </option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <select class="form-control" id="reference" name="d[{{$key}}][reference]">
                                                                            @foreach($references as $reference)
                                                                                <option value="{{$reference}}" @if($reference == $row1->reference) selected @endif>
                                                                                    {{$reference ?? 'sa'}}
                                                                                </option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        @endforeach

                                                    </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="">Conclusion / Confirmité (Physico):</label>
                                                                <textarea class="form-control" name="conformite1" id="conformite1">
                                                                    {{$produit->conformite}}
                                                                </textarea>
                                                            </div>
                                                        </div>

                                                    <br>

                                                    <hr>
                                                    <br>
                                                    <br>
                                                        <h3 class="text text-primary">
                                                            Bulletin d'analyse Micro-biologique
                                                        </h3>

                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control" name="header_1" id="header1" value="Paramètre" placeholder="resultat" >
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control" name="header_2" id="header2" value="Unite" >
                                                            </div>
                                                            <div class="col-md-1">
                                                                <input type="text" class="form-control" name="header_3" id="header3"  value="" >
                                                            </div>

                                                            <div class="col-md-1 extra">    
                                                                <input type="text" class="form-control" name="header_4" id="header4"  value="" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                <input type="text" class="form-control" name="header_5" id="header5"  value="" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                <input type="text" class="form-control" name="header_6" id="header6"  value="" >
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                <input type="text" class="form-control" name="header_7" id="header7"  value="" >
                                                            </div>

                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control" name="header_8" id="header8"  value="" >
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control" name="header_9" id="header9"  value="Référence" >
                                                            </div>
                                                        </div>

                                                        

                                                    <hr>


                                                    @foreach($rows2 as $key=>$row2)
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



                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                                <label for="">Durée (par heure ):</label>
                                                            <input type="text" class="form-control" name="duree" id="duree" placeholder="duree" >
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label for="">Conclusion / Confirmité (Micro):</label>
                                                            <textarea class="form-control" name="conformite2" id="conformite2">
                                                                {{$produit->conformite}}
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



    var categories  = {!! json_encode($categories->toArray()) !!};
    $('.categories').on('change',function(){
        var valueSelected = this.value;
        const found = categories.find(element => element.id == valueSelected);
        console.log(found)
        $('#conformite1').val(found.conformite1)
        $('#conformite2').val(found.conformite2)
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

    $('#produit').on('change',function(){
        var id = this.value
        console.log('sasa')
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