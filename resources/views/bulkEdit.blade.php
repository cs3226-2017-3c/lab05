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
        <h2 class="empty-edit-header">Please choose component</h2>
        <h2 class="edit-header" style="display:none;">Editting <strong id="component"></strong></h2>
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

        <div class="form-group">
            {!! Form::label('component', 'Component:', ['class' => 'control-label']) !!}
            {!! Form::select('component', array('mc' => 'Mini contest','tc' => 'Team contest','hw' => 'Homework','bs' => 'Problem B','ks' => 'Kattis set',' ' => ' '),' ',['class' => 'form-control','onchange'=>"changeBulkEdit(this)"]) !!}
        </div>

        <div class="mc" style="display:none;">
        @foreach($students as $s)
		<div class="form-group">
			{!! Form::label('name', $s->id.'. '.$s->name, ['class' => 'control-label']) !!}
			{!! Form::text('mc', $s->mc, ['class' => 'form-control']) !!}
		</div>
        @endforeach
        </div>

        <div class="tc" style="display:none;">
        @foreach($students as $s)
        <div class="form-group">
            {!! Form::label('name', $s->id.'. '.$s->name, ['class' => 'control-label']) !!}
            {!! Form::text('tc', $s->tc, ['class' => 'form-control']) !!}
        </div>
        @endforeach
        </div>
		
        <div class="hw" style="display:none;">
        @foreach($students as $s)
        <div class="form-group">
            {!! Form::label('name', $s->id.'. '.$s->name, ['class' => 'control-label']) !!}
            {!! Form::text('hw', $s->hw, ['class' => 'form-control']) !!}
        </div>
        @endforeach
        </div>

        <div class="bs" style="display:none;">
        @foreach($students as $s)
        <div class="form-group">
            {!! Form::label('name', $s->id.'. '.$s->name, ['class' => 'control-label']) !!}
            {!! Form::text('bs', $s->bs, ['class' => 'form-control']) !!}
        </div>
        @endforeach
        </div>

        <div class="ks" style="display:none;">
        @foreach($students as $s)
        <div class="form-group">
            {!! Form::label('name', $s->id.'. '.$s->name, ['class' => 'control-label']) !!}
            {!! Form::text('ks', $s->ks, ['class' => 'form-control']) !!}
        </div>
        @endforeach
        </div>

        <div class="edit-button" style="display:none;">
		<div class="form-group">
          {!! app('captcha')->display(); !!}
        </div>
		<div class="form-group"> 
			{!! Form::submit('Update', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
		</div>
        </div>
      
        
      </div>
    </div>
  </div>
  @endsection
@section('footer')
 <script type="text/javascript" src="js/bulkEdit.js"></script>
@endsection