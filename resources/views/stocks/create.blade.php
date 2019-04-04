<!-- create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create a Stock') }}</div>
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
                        @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ \Session::get('success') }}</p>
                        </div><br />
                        @endif
                    <form method="post" action="{{url('stocks')}}">
                          {{csrf_field()}}
                        <div class="row">
                          <div class="col-md-4"></div>
                          <div class="form-group col-md-4">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4"></div>
                            <div class="form-group col-md-4">
                              <label for="price">Price:</label>
                              <input type="text" class="form-control" name="price">
                            </div>
                          </div>
                        
                        <div class="row">
                          <div class="col-md-4"></div>
                            <div class="form-group col-md-4">
                              <label for="price">Quantity:</label>
                              <input type="text" class="form-control" name="quantity">
                            </div>
                          </div>
                                          
                      
                        <div class="row">
                          <div class="col-md-4"></div>
                          <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-success">Add Stock</button>
                          </div>
                        </div>
                    </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
