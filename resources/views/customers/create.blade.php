@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Customer
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
      <form method="post" action="{{ route('customers.store') }}">
      @csrf
          <div class="form-group">
              <label for="name">Nombre cliente:</label>
              <input type="text" class="form-control" name="customer_name"/>
          </div>
          <div class="form-group">
              <label for="cif">CIF :</label>
              <input type="text" class="form-control" name="customer_cif"/>
          </div>
          <div class="form-group">
              <label for="email">Email :</label>
              <input type="text" class="form-control" name="customer_email"/>
          </div>
          <div class="form-group">
              <label for="address">Dirección:</label>
              <input type="text" class="form-control" name="customer_address"/>
          </div>
          <div class="form-group">
              <label for="phone">Número de teléfono:</label>
              <input type="text" class="form-control" name="customer_phone"/>
          </div>
          <button type="submit" class="btn btn-primary">Add customer</button>
      </form>
  </div>
</div>
@endsection