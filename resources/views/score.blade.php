@extends('template')
@section('title')
{{ $student->name }} - Edit Score
@endsection
@section('main')
<div class="container">
  <div class="row">
    <div class="col-md-12" >
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
		<h2>Edit Score for <strong>{{ $student->name }}</strong></h2>
		{!! Form::open(['action' => 'EditScoreController@store']) !!} {{-- Blade shortcut for creating HTML5 form --}}
		<div class="form-group">
			{!! Form::label('mc', 'Mini contest scores:', ['class' => 'control-label']) !!}
			{!! Form::text('mc', $student->mc, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('tc', 'Team contest scores:', ['class' => 'control-label']) !!}
			{!! Form::text('tc', $student->tc, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('hw', 'Homework scores:', ['class' => 'control-label']) !!}
			{!! Form::text('hw', $student->hw, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('bs', 'Problem B scores:', ['class' => 'control-label']) !!}
			{!! Form::text('bs', $student->bs, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('ks', 'Kattis set scores:', ['class' => 'control-label']) !!}
			{!! Form::text('ks', $student->ks, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('ac', 'Achievement scores:', ['class' => 'control-label']) !!}
			{!! Form::text('ac', $student->ac, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('sum', 'Sum of scores:', ['class' => 'control-label']) !!}
			{!! Form::text('sum', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
          {!! app('captcha')->display(); !!}
          {!! Form::hidden('id', $student->id) !!}
        </div>
		<div class="form-group"> {{-- Don't forget to create a submit button --}}
			{!! Form::submit('Update', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
		</div>
        
      </div>
    </div>
  </div>
  @endsection
@section('footer')
<script type="text/javascript" src="/js/sum.js"></script>
@endsection