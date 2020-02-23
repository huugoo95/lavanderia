@extends('layout')
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <hr>
  <div class="d-flex p-2">
    <h1>{{$invoice->customer->name}}</h1>
  </div>
  <div class="container">
    <h3>Factura XXXXX</h3>
    <br><h4><b>{{env('OWNER_PHONE')}}</b></h4>
    <b>{{env('OWNER_EMAIL')}}</b>
    <br>{{env('OWNER_ADDRESS')}}
    <br>{{$invoice->customer->address}}
    <br>{{\Carbon\carbon::now()->toDateString()}}</br>
  </div>

    <table border =1>
    <thead>
        <tr>
          <td>Servicio</td>
          <td>Cantidad</td>
          <td>Precio unitario</td>
          <td>Importe</td>
        </tr>
    </thead>
    <tbody>
        @foreach($invoice->services as $service)
        <tr>
            <td>{{$service->name}}</td>
            <td>{{$mondays}}</td>
            <td>{{$service->price}}</td>
            <td>{{$service->price * $mondays}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>

  </div>
  <br>

<div>
@endsection
