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
        <th>Avg Cost</th>
        <th>Quantity</th>
        <th>Ammount Invested</th>
       </tr>
    </thead>
    <tbody>
     <?php $sum = 0;?>
           
      @foreach($stocks as $stock)
   <?php //dd($stock);?>
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{strtoupper($stock->name)}}</td>
        <td>{{number_format($stock->total_price, 2, '.', ',')}}</td>
        <td>{{$stock->total_quantity}}</td>
         <td>{{number_format($stock->total_price*$stock->total_quantity, 2, '.', ',')}}</td>        
    <?php $sum+= $stock->total_price*$stock->total_quantity;?>
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
