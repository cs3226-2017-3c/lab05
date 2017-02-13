@extends('template')
@section('title')
{{ $student->name }}  - Delete Student 
@endsection
@section('main')
<div class="container-fluid">
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
        <h2>Delete <strong>{{ $student->name }}</strong>?</h2>
        {!! Form::open(['action' => 'DeleteController@store']) !!}
        <div class="form-group">
          {!! app('captcha')->display(); !!}
          {!! Form::hidden('id', $student->id) !!}
        </div>
        <div class="form-group"> 
          {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-lg btn-block']) !!}
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  @endsection
