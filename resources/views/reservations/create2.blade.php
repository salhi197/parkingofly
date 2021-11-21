
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('front2/css/style2.css')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Réservation - Parkingo fly</title>
</head>

<body>
    <div class="book">
        <div class="title">
            <h2>Réservation</h2>
        </div>
        <div class="box">
            <!--Form-->
            <div class="contact form">
                <h3> Remplir le formulaire</h3>
                <form>
                    <div class="formBox">
                        <div class="row50">
                            <div class="inputBox">
                                <span>Nom</span>
                                <input type="text" placeholder="nom" required>
                            </div>
                            <div class="inputBox">
                                <span>Prénom</span>
                                <input type="text" placeholder="prénom" required>
                            </div>
                        </div>

                        <div class="row50">
                            <div class="inputBox">
                                <span>Email</span>
                                <input type="email" placeholder="nom.prenom@gmail.com" required>
                            </div>
                            <div class="inputBox">
                                <span>Téléphone</span>
                                <input type="text" placeholder="05*********" required>
                            </div>
                        </div>

                        <div class="row50">
                            <div class="inputBox">
                                <span>Marque de Véhicule</span>
                                <input type="text" placeholder="Renault , Kia ..." required>
                            </div>
                            <div class="inputBox">
                                <span>N°Matricule</span>
                                <input type="text" placeholder="25007********" required>
                            </div>
                        </div>

                        <div class="row50">
                            <div class="inputBox">
                                <span>Carte Grise</span>
                                <input type="file" required>
                            </div>
                        </div>

                        <div class="row100">
                            <div class="inputBox">
                                <span>Note</span>
                                <textarea>taper votre message...</textarea>
                            </div>
                        </div>

                        <div class="row100">
                            <div class="inputBox">
                                <input type="submit" value="Valider">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--Information de Réservation-->
            <div class="contact info">
                <h3>Information de Réservation :</h3>
                <div class="infoBox">
                    <ul class="info">
                        <li>
                            <span><i class='bx bx-hotel'></i>&nbsp</span>
                            <span>Hotel :</span>

                        </li>
                        <li>
                            <span><i class='bx bx-location-plus'></i>&nbsp</span>
                            <span>N°Place :</span>
                        </li>
                        <li>
                            <span><i class='bx bx-hotel'></i>&nbsp</span>
                            <span>De : </span>
                            <span> &nbsp Heure :</span>
                        </li>
                        <li>
                            <span><i class='bx bx-calendar-check'></i></i>&nbsp</span>
                            <span>à : </span>
                            <span>&nbsp Heure : </span>
                        </li>
                        <li>
                            <span><i class='bx bx-time-five'></i></i>&nbsp</span>
                            <span>Durée : </span>
                        </li>
                        <li>
                            <span><i class='bx bx-money'></i>&nbsp</span>
                            <span>Total : </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="contact map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3198.715500876453!2d3.205258265671708!3d36.70537388909481!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa1c67b8a177ec9ba!2sHyatt%20Regency%20Algiers%20Airport!5e0!3m2!1sfr!2sdz!4v1637091309546!5m2!1sfr!2sdz" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</body>

</html>