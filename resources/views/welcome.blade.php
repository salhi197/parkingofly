
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('mart/assets/images/favicon.png')}}">
    <title>LaBo</title>
    <!-- Custom CSS -->
    <link href="{{asset('mart/dist/css/style.min.css')}}" rel="stylesheet">
>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(../assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(../assets/images/big/3.jpg);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="../assets/images/big/icon.png" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Chercher Réseavations</h2>
                        <p class="text-center">Enter your email address and password to access admin panel.</p>
                        <form class="mt-4" method="post" action="{{route('reservation.search')}}">
                            @csrf
                            <div class="row">
                            <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Date Début</label>
                                        <input class="form-control" id="uname" type="date" value="{{$debut ?? ''}}"
                                            placeholder="enter your username">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Date Fin</label>
                                        <input class="form-control" id="uname" type="date" value="{{$fin ?? ''}}"
                                            placeholder="enter your username">
                                    </div>
                                </div>                                
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Hotel</label>
                                        <select class="form-control" name="hotel">
                                            @forelse($hotels as $hotel)
                                                <option>
                                                    Hotel@
                                                </option>
                                            @empty
                                                <option>
                                                    Liste vide
                                                </option>
                                            @endforelse


                                        </select>

                                    </div>
                                </div>

                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Chercher</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{asset('mart/assets/libs/jquery/dist/jquery.min.js')}} "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('mart/assets/libs/popper.js/dist/umd/popper.min.js')}} "></script>
    <script src="{{asset('mart/assets/libs/bootstrap/dist/js/bootstrap.min.js')}} "></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>