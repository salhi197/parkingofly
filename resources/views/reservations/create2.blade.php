
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Parkingo Fly</title>

        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
        <link rel="stylesheet"
            href="https://unpkg.com/swiper/swiper-bundle.min.css" />

        <!-- font awesome cdn link  -->
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- custom css file cdn link  -->
        <link rel="stylesheet" href="{{asset('front2/css/style1.css')}}">

    </head>
    <body>

        <!-- header section starts  -->

        <header class="header">
            <a href="#" class="logo"> <img class="logo2" src="{{asset('front2/images/logo.png')}}"></a>
            <div class="icons">
                <div class="fas fa-search" id="search-btn"></div>
                <div class="fas fa-moon" id="theme-btn"></div>
                <div class="fas fa-user" id="login-btn"></div>
                <div class="fas fa-bars" id="menu-btn"></div>
            </div>

            <nav class="navbar">
                <a href="#home">Accueil</a>
                <a href="#packages">Hotels</a>
                <a href="#services">Services</a>
                <a href="#contact">Contact</a>

            </nav>

            <form action="" class="login-form">

                <div class="inputBox">
                    <span>Nom Utilasateur</span>
                    <input type="text" placeholder="nom">
                </div>

                <div class="inputBox">
                    <span>Mot de passe</span>
                    <input type="password" placeholder="********">
                </div>

                <div class="remember">
                    <input type="checkbox" name="" id="login-remember">
                    <label for="login-remember">remember me</label>
                </div>
                <i class="fab fa-google-plus"></i>
                <i class="fab fa-facebook"></i>
                <input type="submit" class="btn" value="Se connecter">


            </form>

        </header>

        <div class="book">
            <div class="title">
                <h2>R??servation</h2>
            </div>
            <div class="box">
                <!--Form-->
                <div class="contact form">
                    <h3> Remplir le formulaire</h3>
                    <form action="{{route('reservation.store')}}" method="post" enctype="multipart/form-data" name="formo" id="formo" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="place" value="{{$place ?? ''}}">
                        <input type="hidden" name="debut" value="{{$debut ?? ''}}">
                        <input type="hidden" value="1">
                        <input type="hidden" name="fin" value="{{$fin ?? ''}}">

                        <div class="formBox">
                            <div class="row50">
                                <div class="inputBox">
                                    <span>Nom</span>
                                    <input type="text" placeholder="nom" name="nom"
                                        required>
                                </div>
                                <div class="inputBox">
                                    <span>Pr??nom</span>
                                    <input type="text" placeholder="pr??nom" name="prenom"
                                        required>
                                </div>
                            </div>

                            <div class="row50">
                                <div class="inputBox">
                                    <span>Email</span>
                                    <input type="email"
                                        name="email"
                                        placeholder="nom.prenom@gmail.com"
                                        required>
                                </div>
                                <div class="inputBox">
                                    <span>T??l??phone</span>
                                    <input type="text" placeholder="05*********"
                                        name="telephone"    
                                    required>
                                </div>
                            </div>

                            <div class="row50">
                                <div class="inputBox">
                                    <span>Marque de V??hicule</span>
                                    <input type="text" placeholder="Renault ,Kia ..."  required
                                        name="marque"
                                        >
                                </div>
                                <div class="inputBox">
                                    <span>N??Matricule</span>
                                    <input type="text" name="matricule"
                                        placeholder="25007********" required>
                                </div>
                            </div>



                            <div class="row50">
                                <div class="inputBox">
                                    <span>Carte Grise</span>
                                    <input type="file" name="grise">
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
                <!--Information de R??servation-->
                <div class="contact info">
                    <h3>Information de R??servation :</h3>
                    <div class="infoBox">
                        <ul class="info">
                            <li>
                                <span><i class='bx bx-hotel'></i>&nbsp</span>
                                <span>Hotel :</span>

                            </li>
                            <li>
                                <span><i class='bx bx-location-plus'></i>&nbsp</span>
                                <span>N??Place :</span>
                            </li>
                            <li>
                                <span><i class='bx bx-hotel'></i>&nbsp</span>
                                <span>De : </span>
                                <span> &nbsp Heure :</span>
                            </li>
                            <li>
                                <span><i class='bx bx-calendar-check'></i></i>&nbsp</span>
                            <span>?? : </span>
                            <span>&nbsp Heure : </span>
                        </li>
                        <li>
                            <span><i class='bx bx-time-five'></i></i>&nbsp</span>
                        <span>Dur??e : </span>
                    </li>
                    <li>
                        <span><i class='bx bx-money'></i>&nbsp</span>
                        <span>Total : </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="contact map">
            <h4>Localisation :</h4>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3198.715500876453!2d3.205258265671708!3d36.70537388909481!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa1c67b8a177ec9ba!2sHyatt%20Regency%20Algiers%20Airport!5e0!3m2!1sfr!2sdz!4v1637091309546!5m2!1sfr!2sdz"
                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>