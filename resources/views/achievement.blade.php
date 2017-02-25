@extends('template')
@section('title')
Achievement
@endsection
@section('header')
@endsection
@section('main')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Please choose achievement</h2>
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
			
			{!! Form::open() !!}
			
			<div class="form-group">
				{!! Form::label('achievement', 'Achievement:', ['class' => 'control-label']) !!}
				{!! Form::select('achievement', array('lib' => 'Let it begins', 'qs' => 'Quick starter', 'aic' => 'Active in class', 'su' => 'Surprise us', 'hd' => 'High determination', 'bw' => 'Bookworm', 'ka' => 'Kattis apprentice', 'cs' => 'CodeForces Specialist'), null, ['placeholder' => 'Select Achievement', 'class' => 'form-control','onchange'=>"changeAchievementTab(this)"]) !!}
			</div>
			
			<div class="lib" style="display:none;">
			<div class="form-group">
				{!! Form::label('lib', 'Let it begins:', ['class' => 'control-label']) !!}
				{!! Form::select('lib', 'lib' => 'Let it begins',null,['placeholder' => 'Select Let it begins level','class' => 'form-control'] ) !!}
			</div>
			</div>
			
			<div class="qs" style="display:none;">
			<div class="form-group">
				{!! Form::label('qs', 'Quick starter:', ['class' => 'control-label']) !!}
				{!! Form::select('qs', 'qs' => 'Quick starter',null,['placeholder' => 'Select Quick starter level','class' => 'form-control'] ) !!}
			</div>
			</div>
			
			<div class="aic" style="display:none;">
			<div class="form-group">
				{!! Form::label('aic', 'Active in class:', ['class' => 'control-label']) !!}
				{!! Form::select('aic', array('aicOne' => 'Active in class 1/3', 'aicTwo' => 'Active in class 2/3', 'aicThree' => 'Active in class 3/3'),null, ['placeholder' => 'Select Active in class level', 'class' => 'form-control']) !!}
			</div>
			</div>
						
			<div class="su" style="display:none;">
			<div class="form-group">
				{!! Form::label('su', 'Surprise us:', ['class' => 'control-label']) !!}
				{!! Form::select('su', array('suOne' => 'Surprise us 1/3', 'suTwo' => 'Surprise us 2/3', 'suThree' => 'Surprise us 3/3'),null, ['placeholder' => 'Select Surprise us level', 'class' => 'form-control']) !!}
			</div>
			</div>
			
			<div class="hd" style="display:none;">
			<div class="form-group">
				{!! Form::label('hd', 'High determination:', ['class' => 'control-label']) !!}
				{!! Form::select('hd', 'hd' => 'High determination',null,['placeholder' => 'Select High determination level','class' => 'form-control'] ) !!}
			</div>
			</div>
			
			<div class="bw" style="display:none;">
			<div class="form-group">
				{!! Form::label('bw', 'Bookworm:', ['class' => 'control-label']) !!}
				{!! Form::select{'bw', 'bw' => 'Bookworm',null,['placeholder' => 'Select Bookworm level','class' => 'form-control'] ) !!}
			</div>
			</div>
			
			<div class="ka" style="display:none;">
			<div class="form-group">
				{!! Form::label('ka', 'Kattis apprentice:', ['class' => 'control-label']) !!}
				{!! Form::select('ka', array('kaOne' => 'Kattis apprentice 1/6', 'kaTwo' => 'Kattis apprentice 2/6', 'kaThree' => 'Kattis apprentice 3/6', 'kaFour' => 'Kattis apprentice 4/6', 'kaFive' => 'Kattis apprentice 5/6', 'kaSix' => 'Kattis apprentice 6/6'),null, ['placeholder' => 'Select Kattis apprentice level', 'class' => 'form-control'] !!}
			</div>
			</div>
			
			<div class="cs" style="display:none;">
			<div class="form-group">
				{!! Form::label('cs', 'CodeForces Specialist:', ['class' => 'control-label']) !!}
				{!! Form::select('cs', 'cs' => 'CodeForces Specialist',null,['placeholder' => 'Select CodeForces Specialist level','class' => 'form-control'] ) !!}
			</div>
			</div>
			
			<div class="edit-button" style="display:none;">
			<div class="form-group"> 
				{!! Form::submit('Check achivement', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
			</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
	<script type="text/javascript" src="js/achievementTab.js"></script>
@endsection
