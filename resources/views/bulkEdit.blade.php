@extends('template')
@section('title')
BulkEdit
@endsection
@section('header')
@endsection
@section('main')

<div class="container">

  <div class="row">
    <div class="col-md-12" >
        <h2>Editting {{$component_full}} {{$id}}</h2>
    </div>
  </div>
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
       
		{!! Form::open() !!} {{-- Blade shortcut for creating HTML5 form --}}

       
        @foreach($students as $s)
		<div class="form-group col-md-6 col-md-6 col-sm-6 col-xs-12">
			{!! Form::label('name', $s->id.'. '.$s->name, ['class' => 'control-label']) !!}
			{!! Form::text($component.'['.$s->id.']', $s->data, ['class' => 'form-control']) !!}
		</div>
        @endforeach
  
		<div class="form-group col-md-12">
          {!! app('captcha')->display(); !!}
        </div>
		<div class="form-group col-md-12"> 
			{!! Form::submit('Update', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
		</div>
        
      </div>
    </div>
  </div>
  @endsection
@section('footer')
@endsection