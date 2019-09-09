<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
  <body>
    <div id="app">
      <app></app>
    </div>
    <script src=" {{ mix('js/app.js') }} "></script>
  </body>
</html>
