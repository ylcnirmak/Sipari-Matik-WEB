<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.png">



        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    </head>

    <body class="auth-body-bg">
       
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-4">
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9">
                                        <div>
                                            <div class="text-center">
                                                <div>
                                                    <a href="#" class="authentication-logo">
                                                        <img src="assets/images/yenilogo.png" alt="" height="350" class="auth-logo logo-dark mx-auto">
                                                        <img src="assets/images/yenilogo.png" alt="" height="350" class="auth-logo logo-light mx-auto">
                                                    </a>
                                                </div>
    
                                                <p class="text-muted">Hızlı ve Kolay Erişim Kullanıcı Dostu Arayüz.</p>
                                            </div>

                                            <div class="p-2 mt-5">
                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                                
                                                    <div class="mb-3 auth-form-group-custom mb-4">
                                                        <i class="ri-user-2-line auti-custom-input-icon"></i>
                                                        <label for="username" class="fw-semibold">Mail Adresiniz</label>
                                                        <input class="form-control" type="email" placeholder="Restaurant@siparismatik.net" name="email" :value="old('email')" required autofocus autocomplete="username">
                                                    </div>

                                                    <div class="mb-3 auth-form-group-custom mb-4">
                                                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                        <label for="userpassword">Şifreniz</label>
                                                        <input class="form-control" type="password" placeholder="*****************" name="password" required autocomplete="current-password">
                                                    </div>

                                                    <div class="mt-4 text-center">
                                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">{{ __('Sisteme Giriş') }}</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="mt-5 text-center">
                                                <p><script>document.write(new Date().getFullYear())</script> © Siparişmatik SaaS <b>{{ app()->version() }} PHP {{ phpversion() }}</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="authentication-bg">
                            <div class="bg-overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>
