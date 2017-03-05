@extends('template')
@section('title')
Message Box
@endsection
@section('main')
<div class="container">
  <div class="row">
    <div class="col-md-12" >
      @if (count($errors) > 0) {{-- just list down all errors found --}}
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <h3><strong>Inbox</strong></h3>
      @foreach($inbox as $c)
      <div class="panel panel-default">
        <div class="panel-heading">
          From {{$c->sender}}
        </div>
        <div class="panel-body">
          <h6>{{$c->created_at}}</h6>
          <p>{{$c->text}}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="row">
    <div class="col-md-12" >
      <h3><strong>Outbox</strong></h3>
      @foreach($outbox as $m)
      <div class="panel panel-default">
        <div class="panel-heading">
          To {{$m->receiver}}
        </div>
        <div class="panel-body">
          <h6>{{$m->created_at}}</h6>
          <p>{{$m->text}}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @if (Auth::check() and Auth::user()->access == 1 )
  <div class="row">
    <div class="col-md-12" >
      <h3><strong>All mails</strong></h3>
      @foreach($everything as $e)
      <div class="panel panel-default">
        <div class="panel-heading">
          From {{$e->sender}} To {{$e->receiver}}
        </div>
        <div class="panel-body">
          <h6>{{$e->created_at}}</h6>
          <p>{{$e->text}}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endif
  <div class="row">
    <div class="col-md-12" >
      <h3><strong>New Message</strong></h3>
      {!! Form::open(['files' => 'true']) !!}
      @if (Auth::check() and Auth::user()->access == 1)
      <div class="form-group"> {{-- Group related form components together --}}
        {!! Form::label('receiver', 'To:', ['class' => 'control-label']) !!}
        {!! Form::text('receiver', null, ['class' => 'form-control']) !!}
      </div>
      @endif
      <div class="form-group">
        {!! Form::textarea('text', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group"> {{-- Don't forget to create a submit button --}}
        {!! Form::submit('Send', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
  @endsection
  @section('footer')
  @endsection