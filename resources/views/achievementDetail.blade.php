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
			<h2>{{trans('achievement.studentwith')}} {{$component_full}} {{$id}} {{trans('achievement.achievement')}}</h2>
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
			
			<ol>
			@foreach($students as $s)
			@if($component_full=='Let it begins')
				@if($s->ac_i[0]!='x' && $s->ac_i[0]!='0')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='Quick starter')
				@if($s->ac_i[1]!='x' && $s->ac_i[1]!='0')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='Active in class' && $id=='1')
				@if($s->ac_i[2]=='1')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='Active in class' && $id=='2')
				@if($s->ac_i[2]=='2')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='Active in class' && $id=='3')
				@if($s->ac_i[2]=='3')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='Surprise us' && $id=='1')
				@if($s->ac_i[3]=='1')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='Surprise us' && $id=='2')
				@if($s->ac_i[3]=='2')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='Surprise us' && $id=='3')
				@if($s->ac_i[3]=='3')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='High determination')
				@if($s->ac_i[4]!='x' && $s->ac_i[4]!='0')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='Bookworm')
				@if($s->ac_i[5]!='x' && $s->ac_i[5]!='0')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='Kattis apprentice' && $id=='1')
				@if($s->ac_i[6]=='1')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='Kattis apprentice' && $id=='2')
				@if($s->ac_i[6]=='2')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='Kattis apprentice' && $id=='3')
				@if($s->ac_i[6]=='3')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='Kattis apprentice' && $id=='4')
				@if($s->ac_i[6]=='4')
					<li>{{$s->name}}</li>
				@endif
			@endif
			@if($component_full=='Kattis apprentice' && $id=='5')
				@if($s->ac_i[6]=='5')
					<li>{{$s->name}}</li>
				@endif
			@endif
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
			@endforeach
			</ol>
			
		</div>
	</div>
</div>
@endsection