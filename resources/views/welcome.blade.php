<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    </head>
    <body>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Selamat Datang</h1>
                <p class="lead">Sistem Kepegawaian NICT (Administrasi dan Absensi untuk Admin dan Pegawai)</p>
            </div>
        </div>
        <div class="row justify-content-center" style="margin-top: -3.5rem;">
            <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            @if (Route::has('login'))
                                <div class="top-right links">
                                    @auth
                                        <a class="btn btn-primary btn-rounded btn-block" href="{{ url('/home') }}">Home</a>
                                    @else
                                        <a class="btn btn-primary btn-rounded btn-block" href="{{ route('login') }}">Login</a>

                                        @if (Route::has('register'))
                                            <a class="btn btn-primary btn-rounded btn-block" href="{{ route('register') }}">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
