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
    <a  class="btn btn-secondary"  href="{{ route('index') }}">Menú Principal</a>
    <a  class="btn btn-success" href="{{ route('invoices.create') }}">Añadir Factura</a>
  </div>
  <br>
 
  <table class="table table-striped">
    <thead>
        <tr>
          <td>id</td>
          <td>Cliente</td>
          <td>Servicio</td>
          <td>Periódico</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $invoice)
        <tr>
            <td>{{$invoice->id}}</td>
            <td>{{$invoice->customer->name}}</td>
            <td>{{$invoice->service->price}} euros</td>
            @if ($invoice->regular == 1)
              <td>Envío automatizado</td>
            @else
              <td>Envío manual</td>            
            @endif                
            <td><a href="{{ route('invoices.edit',$invoice->id)}}" class="btn btn-primary">Editar</a></td>
            <td><a href="" class="btn btn-success">Enviar factura</a></td>
            <td>
                <form action="{{ route('invoices.destroy', $invoice->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Borrar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection