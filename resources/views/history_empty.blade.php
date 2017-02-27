@extends('template')
@section('title')
History
@endsection
@section('header')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
  <div class="loader" style="margin:0 auto;"></div>
  <div id="historyLoaded"></div>

@yield('_main')
@endsection
@section('footer')
  <script type="text/javascript" src="js/history_loader.js"></script>
  <script type="text/javascript" src="js/date.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
 @endsection
