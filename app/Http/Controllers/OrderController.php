<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\MessageBag;
use App\Rules\NoLondon;
use Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$allOrders = Order::all();
        return view('orders.order')->with('orders',$allOrders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    if(!auth()->check()){
		    $messages = [
				'Authenticated user is requred'
			];
			
			return redirect()->back()->withErrors(new MessageBag($messages));
		
		} else if(Gate::denies('user-id-low')){
			
			$messages = [
				'user id is not adequate'
			];
			
			return redirect()->back()->withErrors(new MessageBag($messages));
		} else {
			
			$rules = [
				'from' => ['required', new NoLondon()],
				'to'   => ['required', new NoLondon()],
			];
			
			$customMessages = [
				'from.required' => 'You need to insert buyers name in form filed',
				'to.required' => 'You need to insert receiver name in form filed',
			];
			
			$this->validate($request, $rules, $customMessages);
			
			$order = new Order();
			$order->user_id = auth()->id();
			$order->from = $request->from;
			$order->to = $request->to;
			$order->save();
			return redirect()->back();
		}

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
		
		$order = Order::find($id);
		
		
		if(Gate::allows('user-id-low',  $order)){
		
			$report = [
				'errors' 	=> ['No error'],
				'mesages' 	=> ['Yes you can edit it is ok you have created it ok']
			];
			
		} else {
			$report = [
				'errors' 	=> ['You are trying to eddit somebody elses order'],
				'mesages' 	=> ['no success']
			];
		}
		
		$order->from = $request->from;
		$order->to = $request->to;
		$order->save();
		
		
		$errors = new MessageBag($report);
		return redirect()->back()->withErrors($errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
