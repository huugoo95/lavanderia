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
    <a  class="btn btn-success" href="{{ route('services.create') }}">Añadir servicio</a>
  </div>
  <br>
 
  <table class="table table-striped">
    <thead>
        <tr>
          <td>id</td>
          <td>Nombre</td>
          <td>Descripción</td>
          <td>Precio</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $service)
        <tr>
            <td>{{$service->id}}</td>
            <td>{{$service->name}}</td>
            <td>{{$service->description}}</td>
            <td>{{$service->price}} €</td>
            <td><a href="{{ route('services.edit',$service->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('services.destroy', $service->id)}}" method="post">
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