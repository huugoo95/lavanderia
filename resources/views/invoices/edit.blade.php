@extends('layout')
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Editar factura
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
              <label for="invoice_customer">Cliente:</label>
              <select class="form-control" name="invoice_customer">
              @foreach ($customers->all() as $customer)
                @if ($customer->id == $invoice->customer_id)
                  <option value="{{$customer->id}}" selected >{{ $customer->name . " " .  $customer->address}} </option>
                @else
                  <option value="{{$customer->id}}">{{ $customer->name . " " .  $customer->address}} </option>
                @endif
              @endforeach
              </select>              
          </div>
          <div class="form-group">
          <label for="services">Servicios  :</label></br>
          <select multiple id="services" name="services[]" class="form-control">
              @foreach ($services->all() as $service)
                <option value="{{$service->id}}">{{$service->name}} [ {{$service->price}} euros ] </option>
              @endforeach
              </select>
          </div>
          <div class="form-group">
          <label for="invoice_regular">Envío regular :</label>
            <select class="form-control" name="invoice_regular">
                  @if ($invoice->regular == 1)
                    <option selected value="1">Envío periódico </option>
                    <option value="0">Envío puntual </option>
                  @else
                    <option selected value="0">Envío puntual </option>                    
                    <option value="1">Envío periódico </option>
                  @endif                 
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Actualizar servicio</button>
      </form>
  </div>
</div>
@endsection