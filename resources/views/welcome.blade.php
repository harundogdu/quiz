<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        #welcome-body {
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }

        .card {
            background: rgba(235, 232, 232, 0.5);
        }

    </style>
</head>

<body id="welcome-body"
    style="background-image: url('{{asset('uploads/bg.jpg')}}');">
    <div class="container d-flex justify-content-center align-items-center" style="width:100%;height:100vh;">
        <div class="row">
            <div class="card p-4 shadow">
                <div class="col d-flex flex-column justify-content-center align-items-center">
                    <x-jet-authentication-card-logo />
                    @if (Route::has('login'))
                        <div class="d-flex justify-content-center">
                            @auth
                                <a href="{{ url('/panel') }}" class="h5 text-gray-700 underline">Panel</a>
                            @else
                                <a href="{{ route('login') }}" class="h5 text-gray-700 underline">Giriş Yap</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="h5 ml-4 text-gray-700 underline">Kayıt
                                        Ol</a>
                                @endif
                            @endauth
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            All rights reserved © by Harun Doğdu
        </div>
    </div>
    </div>

</body>

</html>
