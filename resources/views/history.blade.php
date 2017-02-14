@extends('template')
@section('title')
{{ $student->name }} - Edit History
@endsection
@section('main')
<div class="container">
  <div class="row">
    <div class="col-md-12" >
      <h3>Score History for <strong>{{ $student->name }}</strong></h3>
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
            <th></th>
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
            <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit">Edit</button> <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete">Delete</button></td>
        @endforeach
          </tr>
        </tbody>
      </table>

    </div>
  </div>
</div>
<!-- Modal -->

  @endsection
