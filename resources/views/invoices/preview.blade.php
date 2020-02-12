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
    <div class="d-flex">
      <div class="p-2">
        <h3>Factura XXXXX</h3>        
        <br><h4><b>646 032 039</b></h4>
        <b>manel.espineira@gmail.com</b>
        <br>Indepencia, 176, Local 1
        <br>08915 Badalona,
        <br>Barcelona
        <br>B66716630        
      </div>
      <div class="p-2"></div>
      <div class="ml-auto p-2">
        A la atención de: Juan José Gallegos García</br>
        Conserje</br>
        Comunidad de Propietarios Nau Santa María 2-8</br>
        Nau Santa María, 2-8</br>
        08017 Barcelona, Barcelona</br>
        Fecha: 14/01/2018</br>
      </div>
    </div>

    <table class="table table-striped">
    <thead>
        <tr>
          <td>Descripción</td>
          <td>Cantidad</td>
          <td>Precio</td>
          <td>Importe</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>123</td>
        </tr>
    </tbody>
  </table>

  </div>
  <br>

<div>
@endsection
