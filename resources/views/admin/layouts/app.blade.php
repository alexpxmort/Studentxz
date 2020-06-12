<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" id="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/buefy/dist/buefy.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/app.css">


    <title>@yield('title')</title>
</head>
<body style=" background-image: linear-gradient(-90deg, white);">

    <div class="container" id="app">
        <custom-nav-bar></custom-nav-bar>
        @yield('content')
        <router-view></router-view>
    </div>
    <script src="/js/app.js"></script>


</body>
</html>


