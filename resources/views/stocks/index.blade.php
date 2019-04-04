<!-- create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Ammount Invested</th>
        <th>Sell Price</th>
        <th>Ammount Returned</th>
        <th>Gain</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
     <?php $sum = 0;?>
      @foreach($stocks as $stock)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{strtoupper($stock['name'])}}</td>
        <td>{{$stock['price']}}</td>
        <td>{{$stock['quantity']}}</td>
        <td>{{$stock['price']*$stock['quantity']}}</td>
        <td>{{$stock['sell_price']}}</td>
        <td>
            @if ($stock['sell_price']>0)
                {{$stock['sell_price']*$stock['quantity']}}</td>
            @endif
        <td>
            @if ($stock['sell_price']>0)
                {{$stock['sell_price']*$stock['quantity']-$stock['price']*$stock['quantity']}}
            @endif
        </td>
        <td><a href="{{action('StockController@edit', $stock['id'])}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('StockController@destroy', $stock['id'])}}" method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
    <?php $sum+= $stock['price']*$stock['quantity'];?>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
      <td colspan="4">Total</td>
      <td colspan="6">={{$sum}}</td>
    </tr>
  </tfoot>
  </table>
  </div>
@endsection
