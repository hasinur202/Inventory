<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>সন্ধিপাঠ লাইব্রেরি ব্যবস্থাপনা</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .logstyle{
                padding: 5px 10px 5px 10px !important;
                color: #fff !important;
                background: green;
                border-radius: 10px;
            }

            .regstyle{
                padding: 5px 10px 5px 10px !important;
                color: #fff !important;
                background: darkslategrey;
                border-radius: 10px;
            }
            .logstyle:hover{
                background:#fff;
                color:black !important;
            }
            .regstyle:hover{
                background:#fff;
                color:black !important;
            }
        </style>
    </head>
    <body style="background-image: url('img/background1.jpg');">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a style="color: white" href="{{ route('/admin/dashboard') }}">
                            ড্যাশবোর্ড</a>
                    @else
                        <a class="logstyle" href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a class="regstyle" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div style="color: white;" class="title m-b-md">
                    সন্ধিপাঠ
                </div>

                {{-- <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div> --}}
            </div>
        </div>
    </body>
</html>