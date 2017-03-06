<?php

namespace App\Http\Controllers;

use App\ProductService;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProductServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productServices = ProductService::all();
        return view('productServices.index')->with('productServices',$productServices);

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
        //Validate the data

        $this->validate($request, array(





        ));


        //Store in the database


        $product = new ProductService();
        $product->item = $request->item;
        $product->type_id = $request->type_id;
        $product->taxable = $request->taxable;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->product_cost = $request->product_cost;
        $product->labor_cost = $request->labor_cost;
        $product->description = $request->description;
        $product->tips = $request->tips;
        $product->requirements = $request->requirements;


        $product->save();

        Session::flash('success', 'The Product was successfully saved!');
        return redirect()->route('productServices.index');




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
