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
  <table class="table table-striped">
    <thead>
        <tr>
          <td>id</td>
          <td>CIF</td>
          <td>NAME</td>
          <td>email</td>
          <td>address</td>
          <td>phone</td>
          <td colspan="2">Action</td>
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
            <td><a href="{{ route('customers.edit',$customer->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('customers.destroy', $customer->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection