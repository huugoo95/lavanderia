@extends('layout')
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Share
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
      <form method="post" action="{{ route('customers.update', $customer->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Nombre de cliente:</label>
          <input type="text" class="form-control" name="customer_name" value={{ $customer->name }} >
        </div>
        <div class="form-group">
              <label for="cif">CIF:</label>
              <input type="text" class="form-control" name="customer_cif" value={{ $customer->cif }}>
          </div>
          <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="customer_email" value={{ $customer->email }} >
          </div>
          <div class="form-group">
              <label for="address">Dirección:</label>
              <input type="text" class="form-control" name="customer_address" value={{ $customer->address }}>
          </div>
          <div class="form-group">
              <label for="phone">Número de teléfono:</label>
              <input type="text" class="form-control" name="customer_phone" value={{ $customer->phone_number }}>
          </div>
          
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection