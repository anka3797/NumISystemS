<!doctype html>
<link href="{{asset('css/app.css')}}" type="text/css" rel="stylesheet"/>
<script src="{{asset('js/app.js')}}" type="text/javascript"></script>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" hfer="{{asset('css/app.css')}}">
        <title>{{config('app.name'), 'BLOG'}}</title>
    </head>
     <body>
         @include("inc.navbar")
         <div class="container">
             @include('inc.messages')
            @yield('content')
         </div>

         <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
         <script>
             CKEDITOR.replace( 'article-ckeditor' );
         </script>
    </body>
</html>