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
    <a  class="btn btn-secondary"  href="{{ route('home') }}">Menú principal</a>
    <a  class="btn btn-success" href="{{ route('customers.create') }}">Añadir cliente</a>
  </div>
  <br>
 
  <table class="table table-striped">
    <thead>
        <tr>
          <td>id</td>
          <td>CIF</td>
          <td>Nombre</td>
          <td>Email</td>
          <td>Dirección</td>
          <td>Número de teléfono</td>
          <td colspan="2">Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $customer)
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->cif}}</td>
            <td>{{$customer->name}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->address}}</td>
            <td>{{$customer->phone_number}}</td>
            <td><a href="{{ route('customers.edit',$customer->id)}}" class="btn btn-primary">Editar</a></td>
            <td>
                <form action="{{ route('customers.destroy', $customer->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection