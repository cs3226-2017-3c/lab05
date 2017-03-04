@extends('template')
@section('title')
Student History
@endsection
@section('main')
<div class="container">
<div class="row">
	<div class="hidden-xs hidden-sm hidden-md col-lg-12" >
		<canvas id="historyChart-lg" width="800" height="500"></canvas>
	</div>
  <div class="hidden-xs col-sm-12 col-md-12 hidden-lg" >
    <canvas id="historyChart-sm" width="800" height="500"></canvas>
  </div>
	<div class="col-xs-12 hidden-sm hidden-md hidden-lg">
		<p>View in bigger screen for the history statistics=P</p>
	</div>
</div>
</div>
@endsection
@section('footer')
	<script type="text/javascript" src="../../js/historyChart.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<!-- draw history chart -->
	<script>drawChart("#historyChart-lg")</script>
@endsection