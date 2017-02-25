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
			<ol>
			@if($component_full=='Kattis apprentice' && $id=='6')
				@if($s->ac_i[6]=='6')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='CodeForces Specialist')
				@if($s->ac_i[7]!='x' && $s->ac_i[7]!='0')
					<li>{{$s->name}}</li>
				@endif
			@endif
			</ol>
			@endforeach
			
		</div>
	</div>
</div>
@endsection