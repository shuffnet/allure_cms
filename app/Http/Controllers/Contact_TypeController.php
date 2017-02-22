<?php

namespace App\Http\Controllers;


use App\Contact_Type;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;

class Contact_TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contact_types = Contact_Type::all();
        return view('contact_types.index')->with('contact_types',$contact_types);



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
        $this->validate($request, [
            'type' => 'required|unique:contact_types|max:255',

        ]);



        //Store in the database

        $contact_type = new Contact_Type;
        $contact_type->type = $request->type;

        $contact_type->save();

        Session::flash('success', 'The Job was successfully saved!');
//
        return redirect()->route('contact_types.index');



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

        $contact_type = Contact_Type::find($id);
        return view('contact_types.edit')->with('contact_type',$contact_type);
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
        //validate data

        $this->validate($request, array(

            'type' => 'required|unique:contact_types|max:255',


        ));
        //save date to database

        $contact_type = Contact_Type::find($id);

        $contact_type->type = $request->input('type');

        $contact_type->save();


        //set flash message

        Session::flash('success', 'Contacted was updated');
        //redirect with flash date to show


        return redirect()->route('contact_types.index');
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
