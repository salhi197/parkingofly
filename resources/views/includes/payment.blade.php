                                                            <div class="modal fade" id="payment{{$reservation->id ?? ''}}" tabindex="-1" role="dialog" aria-labelledby="payment{{$reservation->id ?? ''}}Label" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="paymentLabel">Payment</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <form action="{{route('payment.store')}}" method="post" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <input type="hidden" name="reservation" value="{{$reservation->id ?? ''}}" class="form-control" id="" placeholder="">

                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Date de paiment:</label>
                                                                                    <input type="date" name="date_paiemnt" class="form-control" id="" placeholder="">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Montant à payer :</label>
                                                                                    <input type="text" readonly="true" value="{{ $reservation->tarif ?? '' }}" name="montant" class="form-control" id="" placeholder="">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Réçu de paiment :</label>
                                                                                    <input type="file"  name="recu" class="form-control" id="" placeholder="">
                                                                                </div>


                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">Type de paiment  :</label>
                                                                                    <select class="form-control" name="type">
                                                                                        <option value="espece"> Espece en agence </option>
                                                                                        <option value="cheque">Virement CCP/Banque</option>
                                                                                        <option value="virement"> Paiment Online</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="btn-group" role="group">
                                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                                </div>
                                                                                <button type="button" class="btn btn-danger" data-dismiss="modal"  role="button">Fermer</button>

                                                                            </form>
                                                                        </div>
                                                                    </div>

                                                                          