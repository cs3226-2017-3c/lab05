@extends('template')
@section('title')
Home
@endsection
@section('header')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
  <div class="loader" style="margin:0 auto;"></div>
  <div id="tableLoaded"></div>

@yield('_main')
@endsection
@section('footer')
  <script type="text/javascript" src="js/loader.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.28.5/js/jquery.tablesorter.min.js"></script>
@endsection
