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
  <div >
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
        @php ($sumEuros = 0)
        @foreach($invoice->services as $service)
        <tr>
            <td>{{$service->name}}</td>
            <td>{{$mondays}}</td>
            <td>{{$service->price}}</td>
            <td>{{$service->price * $mondays}}</td>
        </tr>
        @php ($sumEuros+=$service->price * $mondays)  
        @endforeach
        <tr>
          <td></td>
          <td></td>
          <td>Subtotal</td>
          <td>{{$sumEuros}}</td>
        </tr>
        <tr>
          <td></td>
          <td>IVA</td>
          <td>{{env('TAX') * 100}} %</td>
          <td>{{ (env('TAX')) * $sumEuros}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td>Total euros</td>
          <td>{{ (1 + env('TAX')) * $sumEuros}}</td>
        </tr>
    </tbody>
  </table>

  </div>
  <br>

<div>
@endsection
