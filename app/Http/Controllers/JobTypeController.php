<?php

namespace App\Http\Controllers;

use App\JobType;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class JobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $job_types = JobType::all();
        return view('job_types.index')->with('job_types',$job_types);




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //We are using the index to create
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

            'type' => 'required|unique:job_types|max:255',



        ));


        //Store in the database

        $jobtype = new JobType;
        $jobtype->type = $request->type;

        $jobtype->save();

        Session::flash('success', 'The Job was successfully saved!');
        return redirect()->route('job_types.index');





        //Redirect to another page



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

        $job_type = JobType::find($id);
        return view('job_types.edit')->with('job_type',$job_type);
    }


    public function update(Request $request, $id)
    {
        //validate data

        $this->validate($request, array(

            'type' => 'required|unique:job_types|max:255',


        ));
        //save date to database

        $job_type = JobType::find($id);

        $job_type->type = $request->input('type');

        $job_type->save();


        //set flash message

        Session::flash('success', 'Job was updated');
        //redirect with flash date to show


        return redirect()->route('job_types.index');
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
        $job_type = JobType::find($id);
        $job_type->delete();
        Session::flash('success', 'The Job was successfully deleted');
        return redirect()->route('job_types.index');
    }
}
