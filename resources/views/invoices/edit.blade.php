@extends('layout')
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Editar servicio
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('services.update', $service->id) }}">
        @method('PATCH')
        @csrf
          <div class="form-group">
              <label for="service_name">Nombre:</label>
              <input type="text" class="form-control" name="service_name" value="{{ $service->name }}" />
          </div>
          <div class="form-group">
              <label for="service_description">Descripción:</label>
              <input type="text" class="form-control" name="service_description" value="{{ $service->description }}" />
          </div>
          <div class="form-group">
              <label for="service_price">Precio:</label>
              <input type="text" class="form-control" name="service_price" value="{{ $service->price }}" />
          </div>
          <button type="submit" class="btn btn-primary">Actualizar servicio</button>
      </form>
  </div>
</div>
@endsection