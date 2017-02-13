@extends('template') <!-- use template from previous slide -->
@section('title')
Home
@endsection
@section('main') <!-- define a section called main -->

<?php

// Determining value of first, second, third and last

	$sums = [];
	$i = 0;
	foreach($student as $s) {
		$sum = $s->mc+$s->tc+$s->hw+$s->bs+$s->ks+$s->ac;
		$sums[$i] = $sum;
		$i++;
	}
	
	arsort($sums);
	$last = $sums[count($sums)-1];
	$first = $sums[0];
	
	$i = 0;
	foreach($sums as $sum){

		if($sums[$i] == $first){
			unset($sums[$i]);
		}
	$i++;
	}

	$sums = array_values($sums);

	$second = $sums[0];
	
	$i = 0;
	foreach($sums as $sum){

		if($sums[$i] == $second){
			unset($sums[$i]);
		}
	$i++;
	}

	$sums = array_values($sums);

	$third = $sums[0];

//Determining highest value for each category
	$noofcategories = 8;
	$categories = ["mc", "tc", "mctc", "hw", "bs", "ks", "ac", "hwbsksac"];
	$highest = ["mc"=>0,"tc"=>0,"mctc"=>0,"hw"=>0,"bs"=>0,"ks"=>0,"ac"=>0,"hwbsksac"=>0];
	for($i=0;$i<$noofcategories;$i++){
		foreach ($student as $s) {
			switch ($i){
				case "0":
					if($s->mc > $highest["mc"]){
						$highest["mc"] = $s->mc;
					}
					break;
				case "1":
					if($s->tc > $highest["tc"]){
						$highest["tc"] = $s->tc;
					}
					break;
				case "2":
					if($s->tc+$s->mc > $highest["mctc"]){
						$highest["mctc"] = $s->tc+$s->mc;
					}
					break;
				case "3":
					if($s->hw > $highest["hw"]){
						$highest["hw"] = $s->hw;
					}	
					break;	
				case "4":
					if($s->bs > $highest["bs"]){
						$highest["bs"] = $s->bs;
					}	
					break;		
				case "5":
					if($s->ks > $highest["ks"]){
						$highest["ks"] = $s->ks;
					}	
					break;
				case "6":
					if($s->ac > $highest["ac"]){
						$highest["ac"] = $s->ac;
					}
					break;		
				case "7":
					if($s->hw+$s->bs+$s->ks+$s->ac > $highest["hwbsksac"]){
						$highest["hwbsksac"] = $s->hw+$s->bs+$s->ks+$s->ac;
					}	
					break;	
					
			}


		}
	}

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<table id="myTable" class="table table-condensed tablesorter">
				<thead>
					<tr>
						<th class="rank">R</th>
						<th class="hidden-xs flag" onclick= "setAllSameHeight()">Flag</th>
						<th onclick="setAllSameHeight()">Name</th>
						<th class="hidden-xs sortInitialOrder-desc" onclick= "setAllSameHeight()">MC</th>
						<th class="hidden-xs sortInitialOrder-desc" onclick= "setAllSameHeight()">TC</th>
						<th class="sortInitialOrder-desc" onclick="setAllSameHeight()">SPE</th>
						<th class="hidden-xs sortInitialOrder-desc" onclick= "setAllSameHeight()">HW</th>
						<th class="hidden-xs sortInitialOrder-desc" onclick= "setAllSameHeight()">Bs</th>
						<th class="hidden-xs sortInitialOrder-desc" onclick= "setAllSameHeight()">KS</th>
						<th class="hidden-xs sortInitialOrder-desc" onclick= "setAllSameHeight()">Ac</th>
						<th class="sortInitialOrder-desc" onclick="setAllSameHeight()">DIL</th>
						<th class="sortInitialOrder-desc" onclick="setAllDifferentHeight()">Sum</th>
					</tr>
				</thead>
				<tbody>
					@foreach($student as $s)
					<?php $sum = $s->mc+$s->tc+$s->hw+$s->bs+$s->ks+$s->ac; ?>
					@if($sum == $first)
					<tr class = "first">
					@elseif($sum == $second)
					<tr class = "second">					
					@elseif($sum == $third)
					<tr class = "third">					
					@elseif($sum == $last)
					<tr class = "last">	
					@else
					<tr>				
					@endif
						<td>{{$loop->iteration}}</td>
						<td class="hidden-xs"><span class="flag-icon flag-icon-{{strtolower($s->country)}}"></span>{{$s->country}}</td>
						<td><img class="hidden-xs" alt="" src="img/prof.png" height="15"><a href="student/{{$s->id}}">{{$s->name}}</a></td>
					@if($s->mc == $highest["mc"])
					<td class="orange hidden-xs">{{$s->mc}}</td>
					@else
					<td class="hidden-xs">{{$s->mc}}</td>
					@endif
					
					@if($s->tc==$highest["tc"])
					<td class="orange hidden-xs">{{$s->tc}}</td>
					@else
					<td class="hidden-xs">{{$s->tc}}</td>
					@endif	
						
					@if($s->mc+$s->tc==$highest["mctc"])
					<td class="orange">{{$s->mc+$s->tc}}</td>
					@else
					<td>{{$s->mc+$s->tc}}</td>
					@endif
					
					@if($s->hw==$highest["hw"])
					<td class="orange hidden-xs">{{$s->hw}}</td>
					@else
					<td class="hidden-xs">{{$s->hw}}</td>
					@endif	

					@if($s->bs==$highest["bs"])
					<td class="orange hidden-xs">{{$s->bs}}</td>
					@else
					<td class="hidden-xs">{{$s->bs}}</td>
					@endif		

					@if($s->ks==$highest["ks"])
					<td class="orange hidden-xs">{{$s->ks}}</td>
					@else
					<td class="hidden-xs">{{$s->ks}}</td>
					@endif	
					
					@if($s->ac==$highest["ac"])
					<td class="orange hidden-xs">{{$s->ac}}</td>
					@else
					<td class="hidden-xs">{{$s->ac}}</td>
					@endif	
					
					@if($s->hw+$s->bs+$s->ks+$s->ac==$highest["hwbsksac"])
					<td class="orange">{{$s->hw+$s->bs+$s->ks+$s->ac}}</td>
					@else
					<td>{{$s->hw+$s->bs+$s->ks+$s->ac}}</td>
					@endif					
						
					@if($sum == $first)
					<td class="orange">{{$sum}}</td>
					@else
					<td>{{$sum}}</td>
					</tr>
					@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.28.5/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="js/highlight.js"></script>
@endsection
