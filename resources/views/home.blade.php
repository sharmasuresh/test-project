@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

            <div>
               <h4>Stock Section</h4>
               <p>Following is a list of pages</p>
               <ul>
                   <li><a href="/stocks">List All Stock</a></li>    
                   <li><a href="/stocks/create">Create a Stock</a></li>
               </ul>
            </div>

           
            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
