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
      <form method="post" action="{{ route('invoices.update', $invoice->id) }}">
        @method('PATCH')
        @csrf
          <div class="form-group">
              <label for="invoice_name">Nombre:</label>
              <input type="text" class="form-control" name="invoice_<name" value="{{ $invoice->name }}" />
          </div>
          <div class="form-group">
              <label for="invoice_description">Descripción:</label>
              <input type="text" class="form-control" name="invoice_description" value="{{ $invoice->description }}" />
          </div>
          <div class="form-group">
              <label for="invoice_price">Precio:</label>
              <input type="text" class="form-control" name="invoice_price" value="{{ $invoice->price }}" />
          </div>
          <button type="submit" class="btn btn-primary">Actualizar servicio</button>
      </form>
  </div>
</div>
@endsection