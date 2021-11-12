<div class="col-md-1 extra">
                                                                    <label>
                                                                        Unité
                                                                    </label>
                                                                    <select class="form-control"  id="unite1" name="unite1">
                                                                        <?php 
                                                                            $unites = json_decode($produit->unites);
                                                                            foreach($unites as $unite){
                                                                                $u = json_decode(json_decode($unite));
                                                                        ?>
                                                                        <option value="{{$u->id}}">{{$u->nom}}</option>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </select>                                                                    
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                    <label>
                                                                        Unité
                                                                    </label>
                                                                    <select class="form-control"  id="unite2" name="unite2">
                                                                        <?php 
                                                                            $unites = json_decode($produit->unites);
                                                                            foreach($unites as $unite){
                                                                                $u = json_decode(json_decode($unite));
                                                                        ?>
                                                                        <option value="{{$u->id}}">{{$u->nom}}</option>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </select>                                                                    
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                    <label>
                                                                        Unité
                                                                    </label>
                                                                    <select class="form-control"  id="unite3" name="unite3">
                                                                        <?php 
                                                                            $unites = json_decode($produit->unites);
                                                                            foreach($unites as $unite){
                                                                                $u = json_decode(json_decode($unite));
                                                                        ?>
                                                                        <option value="{{$u->id}}">{{$u->nom}}</option>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </select>                                                                    
                                                            </div>
                                                            <div class="col-md-1 extra">
                                                                    <label>
                                                                        Unité
                                                                    </label>
                                                                    <select class="form-control"  id="unite4" name="unite4">
                                                                        <?php 
                                                                            $unites = json_decode($produit->unites);
                                                                            foreach($unites as $unite){
                                                                                $u = json_decode(json_decode($unite));
                                                                        ?>
                                                                        <option value="{{$u->id}}">{{$u->nom}}</option>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </select>                                                                    
                                                            </div>