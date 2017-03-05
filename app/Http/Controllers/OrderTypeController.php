<?php

namespace App\Http\Controllers;

use App\OrderType;
use Illuminate\Http\Request;
use Session;

use App\Http\Requests;

class OrderTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $order_types = OrderType::all();
        return view('order_types.index')->with('order_types',$order_types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //Validate the data
        $this->validate($request, [
            'type' => 'required|unique:contact_types|max:255',

        ]);



        //Store in the database

        $order_type = new OrderType;
        $order_type->type = $request->type;

        $order_type->save();

        Session::flash('success', 'The Job was successfully saved!');
//
        return redirect()->route('order_type.index');


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
        //
        $order_type = OrderType::find($id);
        return view('order_types.edit')->with('order_type',$order_type);

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
        //

        $this->validate($request, array(

            'type' => 'required|unique:order_types|max:255',


        ));
        //save date to database

        $order_type = OrderType::find($id);

        $order_type->type = $request->input('type');

        $order_type->save();


        //set flash message

        Session::flash('success', 'Order Type was updated');
        //redirect with flash date to show


        return redirect()->route('order_type.index');
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
