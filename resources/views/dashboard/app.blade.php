<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/f40c32a411.js" crossorigin="anonymous"></script>
    <style>
        html {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            width: 100%;
        }

        @font-face {
            font-family: Futura;
            src: url(/font/Futura.ttf);
        }

        @font-face {
            font-family: Noto;
            src: url(/font/Noto.otf);
        }

        .nav {
            height: 100%;
        }

        .title-nav {
            font-weight: 700;
            font-size: 1.8rem;
        }

        .title-page {
            font-family: Futura;
        }

        .hr-title {
            width: 40%;
            border: 3px solid grey;
        }

        .img-profil {
            width: 7rem;
            height: 7rem;
            border: 3px solid rgb(0, 235, 110);
        }

        .hr-nav {
            width: 70%;
            border: 1px solid white;
        }

        #footer {
            position: relative;
            bottom: 0;
            margin-top: 10px;
            width: 100%;
        }

        .cont {
            min-height: 400px;
        }

        @media screen and (min-width:767px) {
            #footer {
                margin-top: 0px;
            }
        }

        @media screen and (max-width:400px) {
            .nav {
                height: 100%;
            }
        }
    </style>
    @yield('style')
</head>

<body>
    <nav class="navbar navbar-expand-lg-light bg-dark">
        <span class="navbar-brand mb-0 h1 text-white">Selamat Datang {{ session('name')}}</span>
    </nav>
    <section>
        <div class="row no-gutters">
            @include('dashboard.nav')
            <div class="col-lg-10 pb-5">
                @yield('content')
            </div>
            @include('dashboard.footer')
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js"></script>
    @yield('extra-css')
</body>

</html>