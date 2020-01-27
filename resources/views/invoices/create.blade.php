@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Añadir factura
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br/>
    @endif
      <form method="post" action="{{ route('invoices.store') }}">
      @csrf
          <div class="form-group">
              <label for="invoice_customer">Cliente:</label>
              <select class="form-control" name="invoice_customer">
              @foreach ($customers->all() as $customer)
                <option value="{{$customer->id}}">{{ $customer->name . " " .  $customer->address}} </option>
              @endforeach
              </select>              
          </div>
          <div class="form-group">
              <label for="invoice_service">Servicio  :</label>
              <select class="form-control" name="invoice_service">
              @foreach ($services->all() as $service)
                <option value="{{$service->id}}">{{ $service->name . " " .  $service->address}} </option>
              @endforeach
              </select>              
          </div>
          <div class="form-group">
          <label for="invoice_occasional">Envío ocasional :</label>
            <select class="form-control" name="invoice_occasional">
              <option value="1">Envío puntual </option>
              <option value="0">Envío periódico </option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Añadir factura</button>
      </form>
  </div>
</div>
@endsection