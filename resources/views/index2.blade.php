
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
        <link rel="stylesheet" href="{{asset('css/toastr.css')}}">

        <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
        <style>

        #global-loader {
            position: fixed;
            z-index: 50000;
            background: #fff;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            height: 100%;
            width: 100%;
            margin: 0 auto;
            overflow: hidden;
        }

        .loader-img {
            position: absolute;
            left: 0;
            right: 0;
            text-align: center;
            top: 45%;
            margin: 0 auto;
        }

        </style>

    </head>
    <body>
    <div id="global-loader">
			<img src="{{asset('img/logoofficiel.png')}}" class="loader-img" width="150px" alt="Loader">
		</div>

        <!-- header section starts  -->

        <header class="header">

            <a href="#" class="logo"> <img class="logo2" src="{{asset('img/logoofficiel.png')}}"></a>
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

        <!-- header section ends -->

        <!-- home section starts  -->

        <section class="home" id="home">
            <div class="content">
                <h2>Réservez votre place de parking</h2>
                <p>
                    Comparez et réservez les meilleures offres parmi tous les
                    parkings Faites jusqu'à 60% d'économie.
                </p>
            </div>
            <div class="form-container" data-aos="zoom-in">
                <br><br><br><br><br><br><br><br><br>

                <form action="{{route('reservation.search')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="inputBox">
                        <span>Parking</span>
                        <select class="form-control">
                            @foreach($hotels as $hotel)
                                <option value="{{$hotel->id}}">{{$hotel->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="inputBox">
                        <span>Début</span>
                        <input type="date" name="debut" min="{{date('Y-m-d')}}">
                    </div>
                    <div class="inputBox1">
                        <span>Heure</span>
                        <input type="time" name="heure_debut">
                    </div>
                    <div class="inputBox">
                        <span>Fin</span>
                        <input name="fin" type="date">
                    </div>
                    <div class="inputBox1">
                        <span>Heure</span>
                        <input type="time" name="heure_fin">
                    </div>

                    <input type="submit" value="GO" class="btn">

                </form>

            </div>
        </section>

       

        <section class="packages" id="packages">

            <h1 class="heading"> Nos <span>Parkings</span> </h1>
            <form action="{{route('reservation.search')}}" method="post">
                <div class="box-container">
                    <div class="box" data-aos="fade-up">
                        <div class="image">
                            <img src="{{asset('front2/images/h1.jpg')}}" alt="">
                            <h3> <i class="fas fa-map-marker-alt"></i> Aéroport
                            </h3>
                        </div>
                        <div class="content">
                            <div class="price"> Hyatt Regency</div>
                            <a href="#" class="btn"> Réserver ici</a>
                        </div>
                    </div>

                    <div class="box" data-aos="fade-up">
                        <div class="image">
                            <img src="{{asset('front2/images/h3.jpg')}}" alt="">
                            <h3> <i class="fas fa-map-marker-alt"></i> Bab Ezzouar</h3>
                        </div>
                        <div class="content">
                            <div class="price"> Hotel Mercure </div>
                            <a href="#" class="btn"> Réserver ici</a>
                        </div>
                    </div>

                    <div class="box" data-aos="fade-up">
                        <div class="image">
                            <img src="{{asset('front2/images/h4.jpg')}}" alt="">
                            <h3> <i class="fas fa-map-marker-alt"></i> Bab Ezzouar
                            </h3>
                        </div>
                        <div class="content">
                            <div class="price"> Hotel Maryott </div>
                            <a href="#" class="btn"> Réserver ici</a>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <!-- packages section ends -->

        <!-- services section starts  -->

        <section class="services" id="services">

            <h1 class="heading"> Nos <span>services</span> </h1>

            <div class="box-container">

                <div class="box" data-aos="zoom-in">
                    <span>01</span>
                    <i class="fas fa-hotel"></i>
                    <h3>Parking sous surveillence</h3>
                    <p>LE PARKING EST SECURISEE 24/24H ET COUVERT AVEC UN PASSAGE PIETON PRIVEE.</p>
                </div>

                <div class="box" data-aos="zoom-in">
                    <span>02</span>
                    <i class="fas fa-plane"></i>
                    <h3>A coté de l'aéroport</h3>
                    <p>Des navettes qui transmit le voyageur de l’hotel à l’aéroport gratuitement.</p>
                </div>

                <div class="box" data-aos="zoom-in">
                    <span>03</span>
                    <i class="fas fa-utensils"></i>
                    <h3>Tarifs moins chers</h3>
                    <p>
                        Notre politique de vente à 50% et 60 % moins cher de prix du marché .
                    </p>
                </div>

                <div class="box" data-aos="zoom-in">
                    <i class="fas fa-globe"></i>
                    <h3>
                        Stationnement 24h/7
                    </h3>
                    <p>Places disponibles à tous moment.</p>
                </div>

                <!-- <div class="box" data-aos="zoom-in">
                    <span>05</span>
                    <i class="fas fa-hiking"></i>
                    <h3>new adventures</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Officia, rem.</p>
                </div> -->

                <!-- <div class="box" data-aos="zoom-in">
                    <span>01</span>
                    <i class="fas fa-bullhorn"></i>
                    <h3>safety guide</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Officia, rem.</p>
                </div> -->

            </div>

        </section>


        <section class="contact" id="contact">

            <h1 class="heading"> <span>contactez</span> nous </h1>

            <form action="" data-aos="zoom">

                <div class="inputBox">
                    <input type="text" placeholder="nom" data-aos="fade-up">
                    <input type="email" placeholder="email" data-aos="fade-up">
                </div>

                <div class="inputBox">
                    <input type="number" placeholder="téléphone"
                        data-aos="fade-up">
                    <input type="text" placeholder="sujet" data-aos="fade-up">
                </div>

                <textarea name="" placeholder="your message" id="" cols="30"
                    rows="10" data-aos="fade-up"></textarea>

                <input type="submit" value="Envoyer" class="btn">

            </form>

        </section>

        <!-- contact section ends -->

        <!-- blog section starts  -->
        <!--
        <section class="blogs" id="blogs">

            <h1 class="heading"> our <span>blogs</span> </h1>

            <div class="box-container">

                <div class="box" data-aos="fade-up">
                    <div class="image">
                        <img src="{{asset('front2/images/blog-1')}}.svg" alt="">
                    </div>
                    <div class="content">
                        <h3>explore the world now, adventure awaits</h3>
                        <a href="#" class="btn">read more</a>
                        <div class="icons">
                            <a href="#"> <i class="fas fa-calendar"></i> 1st
                                jan, 2021 </a>
                            <a href="#"> <i class="fas fa-user"></i> by admin
                            </a>
                        </div>
                    </div>
                </div>

                <div class="box" data-aos="fade-up">
                    <div class="image">
                        <img src="{{asset('front2/images/blog-2')}}.svg" alt="">
                    </div>
                    <div class="content">
                        <h3>explore the world now, adventure awaits</h3>
                        <a href="#" class="btn">read more</a>
                        <div class="icons">
                            <a href="#"> <i class="fas fa-calendar"></i> 1st
                                jan, 2021 </a>
                            <a href="#"> <i class="fas fa-user"></i> by admin
                            </a>
                        </div>
                    </div>
                </div>

                <div class="box" data-aos="fade-up">
                    <div class="image">
                        <img src="{{asset('front2/images/blog-3')}}.svg" alt="">
                    </div>
                    <div class="content">
                        <h3>explore the world now, adventure awaits</h3>
                        <a href="#" class="btn">read more</a>
                        <div class="icons">
                            <a href="#"> <i class="fas fa-calendar"></i> 1st
                                jan, 2021 </a>
                            <a href="#"> <i class="fas fa-user"></i> by admin
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        blog section ends -->
        <!-- footer section starts  -->

        <section class="footer">

            <div class="box-container">

                <div class="box" data-aos="fade-up">
                    <h3>Emplacements</h3>
                    <a href="#"> <i class="fas fa-map-marker-alt"></i> Aéroport
                    </a>
                    <a href="#"> <i class="fas fa-map-marker-alt"></i> Bab
                        Ezzouar
                    </a>
                    <a href="#"> <i class="fas fa-map-marker-alt"></i>
                    </a>
                    <a href="#"> <i class="fas fa-map-marker-alt"></i>
                    </a>
                    <a href="#"> <i class="fas fa-map-marker-alt"></i>
                    </a>
                </div>

                <div class="box" data-aos="fade-up">
                    <h3>Liens Rapides</h3>
                    <a href="#"> <i class="fas fa-chevron-right"></i> home </a>
                    <a href="#"> <i class="fas fa-chevron-right"></i> packages
                    </a>
                    <a href="#"> <i class="fas fa-chevron-right"></i> services
                    </a>
                    <a href="#"> <i class="fas fa-chevron-right"></i> pricing
                    </a>
                    <a href="#"> <i class="fas fa-chevron-right"></i> review
                    </a>
                    <a href="#"> <i class="fas fa-chevron-right"></i> contact
                    </a>
                    <a href="#"> <i class="fas fa-chevron-right"></i> blogs </a>
                </div>

                <div class="box" data-aos="fade-up">
                    <h3>contact info</h3>
                    <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a>
                    <a href="#"> <i class="fas fa-phone"></i> +111-222-3333 </a>
                    <a href="#"> <i class="fas fa-envelop"></i>
                        contact@parkingo-fly.com</a>
                    <a href="#"> <i class="fas fa-map-marker-alt"></i> Alger
                    </a>
                </div>

                <div class="box" data-aos="fade-up">
                    <h3>Suivez-nous</h3>
                    <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
                    <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
                    <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
                    <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
                </div>

            </div>

            <div class="credit"> creadet by <span>H-Evolutions & Power Evo</span>
                | all
                rights reserved </div>

        </section>

        <!-- footer section ends -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script src="{{asset('front2/js/jquery.min.js')}}"></script>

        <script src="{{asset('js/toastr.min.js')}}"></script>	

        <!-- custom js file link  -->
        <!-- <script src="{{asset('js/scripts.js')}}"></script> -->

<script>
    AOS.init({
        duration:800,
        delay:400
        
    });

</script>

        <script>
$(window).on("load",function(){
  $("#global-loader").fadeOut("slow");
})


            @if(session('error'))
                $(function(){
                    toastr.error('{{Session::get("error")}}')
                })
            @endif

            @if(session('success'))
                toastr.success('{{Session::get("success")}}')
            @endif
            
                // toastr.success('{{Session::get("success")}}')
            // toastr.success('reservation inséré avec succés , L&#039;administration Va vous contacter ')
            

        </script>




    </body>
</html>