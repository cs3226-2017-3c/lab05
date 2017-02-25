@extends('template')
@section('title')
Achievement Detail
@endsection
@section('header')
@endsection
@section('main')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Students with {{$component_full}} {{$id}} achievement</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			
			@foreach($students as $s)
			@if($component_full=='cs')
				@if($s->ac_i[7]!='x' && $s->ac_i[7]!='0')
					{{$s->name}}
				@endif
			@endif
			@endforeach
			
		</div>
	</div>
</div>
@endsection