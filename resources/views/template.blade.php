<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>@yield('title') - CS3226 RankList 2020</title>

  <!-- Bootstrap -->    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  
  @yield('header')
  

  <!-- Custom styles for this template -->
  <link href="/css/navbar.css" rel="stylesheet">
  <link href="/css/flag-icon.min.css" rel="stylesheet">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <!-- <link href="https://fonts.googleapis.com/css?family=Nunito+Sans%7cRaleway" rel="stylesheet"> -->
</head>
<body>
  <div class="container">
    @include('flash::message')
  </div>
  @include('_navigation')
   
  @yield('main')
   
  @include('_footer')

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
  </script>
  @yield('footer')
</body>
</html>
