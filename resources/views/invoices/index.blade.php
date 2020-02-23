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
  <div class="d-flex justify-content-between">
    <a  class="btn btn-secondary" href="{{ route('index') }}">Menú Principal</a>
    <a  class="btn btn-success" href="{{ route('invoices.create') }}">Añadir Factura</a>
  </div>
  <br>

  <table class="table table-striped">
    <thead>
        <tr>
          <td>id</td>
          <td>Cliente</td>
          <td>Servicios</td>
          <td>Periódico</td>
          <td colspan="3">Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $invoice)
        <tr>
            <td>{{$invoice->id}}</td>
            <td>{{$invoice->customer->name}}</td>
            <td>
            @foreach($invoice->services as $service)
            {{$service->name}} [ {{$service->price}} € ]
            @endforeach
            </td>
            @if ($invoice->regular == 1)
              <td>Envío automatizado</td>
            @else
              <td>Envío manual</td>
            @endif
            <td><a href="{{ route('invoices.edit',$invoice->id)}}" class="btn btn-primary">Editar</a></td>
            <td><a href="{{ route('invoices.preview', $invoice->id)}}" class="btn btn-success">Previsualizar factura</a></td>           
            <td>
                <form action="{{ route('invoices.send', $invoice->id)}}" method="post">
                  @csrf
                  @if ($invoice->logs->first())
                    <button class="btn btn-warning" type="submit">Enviar (últ: {{$invoice->logs->last()->created_at->format('Y-m-d')}})</button>
                  @else
                    <button class="btn btn-warning" type="submit">Enviar (Todavía ninguna enviada))</button>
                  @endif
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection
