<?php

namespace App\Http\Controllers;
use App\Stock;
use App\User;

use Illuminate\Http\Request;
use DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('stocks.index')->with('stocks', $user->stocks);
       // $stocks = Stock::all()->toArray();
        //return view('stocks.index')->with('stocks', $stocks);
    }
    
    public function aggregate()
    {
       // $user_id = auth()->user()->id;
       // $user = User::find($user_id)>groupBy('name');
       // return view('stocks.aggregate')->with('stocks', $user->stocks);      
        $stocks = DB::table('stocks')
                ->select('name', DB::raw('SUM(quantity) as total_quantity, avg(price) as total_price'))
                ->groupBy('name')               
                ->get();   
       // dd($stocks);
             //   die;
        return view('stocks.aggregate')->with('stocks', $stocks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stocks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $this->validate(request(), [
          'name' => 'required',
          'price' => 'required|numeric',
          'quantity' => 'required|numeric'
        ]);
        $stock = new Stock;
        $stock->name = $request->input('name');
        $stock->price = $request->input('price');
        $stock->quantity = $request->input('quantity');
        $stock->user_id = auth()->user()->id;
        //echo "<pre>";
        //print_r($stock);
       // die;
        $stock->save();
        return back()->with('success', 'Stock has been added');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = Stock::find($id);
        
        return view('stocks.edit')->with('stock', $stock);
    }
    
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $stock = Stock::find($id);
        $this->validate(request(), [
          'name' => 'required',
          'price' => 'required|numeric'
        ]);
        $stock->name = $request->get('name');
        $stock->price = $request->get('price');
        $stock->quantity = $request->get('quantity');
        $stock->sell_price = $request->get('sell_price');
        $stock->save();
        return redirect('stocks')->with('success','Stock has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::find($id);
        $stock->delete();
        return redirect('stocks')->with('success','Stock has been deleted');
    }
}
