
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
        <link rel="stylesheet" href="{{asset('front/css/style.css')}}">

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

        <!-- header section ends -->

        <!-- home section starts  -->

        <section class="home" id="home">
            <div class="content">
                <h2>R??servez votre place de parking</h2>
                <p>
                    Comparez et r??servez les meilleures offres parmi tous les
                    parkings Faites jusqu'?? 60% d'??conomie.
                </p>
            </div>
            <div class="form-container" data-aos="zoom-in">
                <br><br><br><br><br><br><br><br><br>

                <form action="{{route('reservation.search')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="inputBox">
                        <span>Parking</span>
                        <input type="text" placeholder="choisir l'Hotel">
                    </div>

                    <div class="inputBox">
                        <span>D??but</span>
                        <input type="date" name="debut" min="{{date('Y-m-d')}}">
                    </div>
                    <div class="inputBox1">
                        <span>Heure</span>
                        <input type="time">
                    </div>
                    <div class="inputBox">
                        <span>Fin</span>
                        <input name="fin" type="date">
                    </div>
                    <div class="inputBox1">
                        <span>Heure</span>
                        <input type="time">
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
                            <h3> <i class="fas fa-map-marker-alt"></i> A??roport
                            </h3>
                        </div>
                        <div class="content">
                            <div class="price"> Hyatt Regency</div>
                            <a href="#" class="btn"> R??server ici</a>
                        </div>
                    </div>

                    <div class="box" data-aos="fade-up">
                        <div class="image">
                            <img src="{{asset('front2/images/h3.jpg')}}" alt="">
                            <h3> <i class="fas fa-map-marker-alt"></i> Bab Ezzouar</h3>
                        </div>
                        <div class="content">
                            <div class="price"> Hotel Mercure </div>
                            <a href="#" class="btn"> R??server ici</a>
                        </div>
                    </div>

                    <div class="box" data-aos="fade-up">
                        <div class="image">
                            <img src="{{asset('front2/images/h2.jpg')}}" alt="">
                            <h3> <i class="fas fa-map-marker-alt"></i> Bab Ezzouar
                            </h3>
                        </div>
                        <div class="content">
                            <div class="price"> Hotel Ibis </div>
                            <a href="#" class="btn"> R??server ici</a>
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
                    <h3>affordable hotels</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Officia, rem.</p>
                </div>

                <div class="box" data-aos="zoom-in">
                    <span>02</span>
                    <i class="fas fa-plane"></i>
                    <h3>fastest travel</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Officia, rem.</p>
                </div>

                <div class="box" data-aos="zoom-in">
                    <span>03</span>
                    <i class="fas fa-utensils"></i>
                    <h3>food and drinks</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Officia, rem.</p>
                </div>

                <div class="box" data-aos="zoom-in">
                    <span>04</span>
                    <i class="fas fa-globe"></i>
                    <h3>around the world</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Officia, rem.</p>
                </div>

                <div class="box" data-aos="zoom-in">
                    <span>05</span>
                    <i class="fas fa-hiking"></i>
                    <h3>new adventures</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Officia, rem.</p>
                </div>

                <div class="box" data-aos="zoom-in">
                    <span>01</span>
                    <i class="fas fa-bullhorn"></i>
                    <h3>safety guide</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Officia, rem.</p>
                </div>

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
                    <input type="number" placeholder="t??l??phone"
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

        <!-- blog section ends -->
        -->
        <!-- footer section starts  -->

        <section class="footer">

            <div class="box-container">

                <div class="box" data-aos="fade-up">
                    <h3>Emplacements</h3>
                    <a href="#"> <i class="fas fa-map-marker-alt"></i> A??roport
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
        <!-- custom js file link  -->
        <script src="js/script.js"></script>

<script>
    AOS.init({
        duration:800,
        delay:400
    });
</script>
    </body>
</html>