<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>@yield('title') - CS3226 RankList 2020</title>

  <!-- Bootstrap -->    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.css">


  <!-- Custom styles for this template -->
  <link href="/css/navbar.css" rel="stylesheet">
  <link href="/css/flag-icon.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans%7cRaleway" rel="stylesheet">
</head>
<body>
  <div class="container">  
   @include('_navigation')
   
   @yield('main')
   
   @include('_footer')

   @yield('footer')
 </div>
</body>
</html>
