@extends('template')
@section('title')
Student History
@endsection
@section('main')
<div class="container">
<div class="row">
	<div class="hidden-xs hidden-sm hidden-md col-lg-12">
		<p>The legend is sorted in <b>descending</b> order according to latest sum.</p>
		<canvas id="historyChart-lg" width="800" height="500"></canvas>
	</div>
  	<div class="hidden-xs col-sm-12 col-md-12 hidden-lg">
  		<p>The legend is sorted in <b>descending</b> order according to latest sum.</p>
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
	<script>drawChart("#historyChart-lg", drawChartSmall, "#historyChart-sm")</script>
@endsection