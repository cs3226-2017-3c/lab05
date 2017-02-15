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
        <h2>Please choose component</h2>
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
            {!! Form::select('component', array('mc' => 'Mini contest','tc' => 'Team contest','hw' => 'Homework','bs' => 'Problem B','ks' => 'Kattis set'),null,['placeholder' => 'Select component','class' => 'form-control','onchange'=>"changeBulkEdit(this)"]) !!}
        </div>

        <div class="mc" style="display:none;">
        <div class="form-group">
            {!! Form::label('mc', 'Mini contest:', ['class' => 'control-label']) !!}
            {!! Form::select('mc', array('1' => '1','2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9'),'1',['placeholder' => 'Select Mini Contest','class' => 'form-control']) !!}
        </div>
        </div>

        <div class="tc" style="display:none;">
        <div class="form-group">
            {!! Form::label('tc', 'Team contest:', ['class' => 'control-label']) !!}
            {!! Form::select('tc', array('1' => '1','2' => '2'),'1',['placeholder' => 'Select Team Contest','class' => 'form-control']) !!}
        </div>
        </div>

        <div class="hw" style="display:none;">
        <div class="form-group">
            {!! Form::label('hw', 'Homework:', ['class' => 'control-label']) !!}
            {!! Form::select('hw', array('1' => '1','2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10'),'1',['placeholder' => 'Select Homework','class' => 'form-control']) !!}
        </div>
        </div>

        <div class="bs" style="display:none;">
        <div class="form-group">
            {!! Form::label('bs', 'Prolem B:', ['class' => 'control-label']) !!}
            {!! Form::select('bs', array('1' => '1','2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9'),'1',['placeholder' => 'Select Problem B','class' => 'form-control']) !!}
        </div>
        </div>

        <div class="ks" style="display:none;">
        <div class="form-group">
            {!! Form::label('ks', 'Kattis Set:', ['class' => 'control-label']) !!}
            {!! Form::select('ks', array('1' => '1','2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10','11' => '11','12' => '12'),'1',['placeholder' => 'Select Kattis Set','class' => 'form-control']) !!}
        </div>
        </div>

        <div class="edit-button" style="display:none;">
		<div class="form-group"> 
			{!! Form::submit('Start Bulk Edit', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
		</div>
        </div>
      
        
      </div>
    </div>
  </div>
  @endsection
@section('footer')
 <script type="text/javascript" src="js/bulkEdit.js"></script>
@endsection