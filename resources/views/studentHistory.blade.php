@extends('template')
@section('title')
{{ $student->name }} - History
@endsection
@section('main')
<div class="container">
  <div class="row">
    <div class="col-md-12" >
      <h2>Score History for <strong>{{ $student->name }}</strong></h2>
      <canvas class = "hidden-xs" id="historyChart" width="1000" height="400"></canvas>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th class="hidden-xs">MC</th>
            <th class="hidden-xs">TC</th>
            <th>SPE</th>
            <th class="hidden-xs">HW</th>
            <th class="hidden-xs">Bs</th>
            <th class="hidden-xs">KS</th>
            <th class="hidden-xs">Ac</th>
            <th>DIL</th>
            <th>Sum</th>
            <th>Effective Date</th>
            @if (Auth::guest()) @else 
            <th>Action</th>
            @endif
          </tr>
        </thead>
        <tbody>
        @foreach($score as $sc)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td class="hidden-xs">{{$sc->mc}}</td>
            <td class="hidden-xs">{{$sc->tc}}</td>
            <td>{{$sc->spe}}</td>
            <td class="hidden-xs">{{$sc->hw}}</td>
            <td class="hidden-xs">{{$sc->bs}}</td>
            <td class="hidden-xs">{{$sc->ks}}</td>
            <td class="hidden-xs">{{$sc->ac}}</td>
            <td>{{$sc->dil}}</td>
            <td>{{$sc->sum}}</td>
            <td>{{$sc->effective_from}}</td>
            @if (Auth::guest()) @else 
            <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit">Edit</button> <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" onclick="event.preventDefault();$('#delete-form input[name=\'id\']').val({{$sc->id}}); $('.modal-body strong').text({{$sc->id}});">Delete</button></td>
            @endif
        @endforeach
          </tr>
        </tbody>
      </table>
      <!-- Modal -->
      <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Score History</h5>
            </div>
            <div class="modal-body">
              You are going to delete score history with id <strong id="delete-id"></strong>...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger" onclick="$('#delete-form').submit();">Delete</button>
            </div>
          </div>
        </div>
      </div>

      {!! Form::open(['action' => ['DeleteScoreController@store', $student->id], 'id' => 'delete-form']) !!}
      {!! Form::hidden('id') !!}
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Modal -->
@endsection

@section('footer')
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <script type="text/javascript" src="../../js/historyChart.js"></script>
  <!-- draw history chart -->
  <script>drawChart("#historyChart");</script>
@endsection
