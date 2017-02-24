<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Contact_Type;
use App\Job;
use App\JobType;
use App\Role;
use Session;
use Illuminate\Http\Request;

use App\Http\Requests;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Create variable and store all the jobs in it
        // return a view and pass in the variable
        $jobs = Job::all();

       // return view('jobs.index')->withJobs($jobs);
       return view('jobs.index')->with('jobs', $jobs);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $job_types = JobType::all();
        $roles = Role::all();
        return view('jobs.create')->withJob_types($job_types)->withRoles($roles);

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

            'job_type_id' => 'required|max:255',
            'name' => 'required|max:255',
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required|max:255|email',
            'date' => 'date'
        ));

         //Store in the database

        $contact = new Contact;
        $contact->fname = $request->fname;
        $contact->lname = $request->lname;
        $contact->email = $request->email;

        $contact->save();

        $newcontact = array($contact->id);


        $job = new Job;
        $job->job_type_id = $request->job_type_id;
        $job->name = $request->name;
        $job->date = $request->date;
        $job->description = $request->description;

        $job->save();
        $job->contacts()->sync($newcontact, false);


        Session::flash('success', 'The Job was successfully saved!');
        return redirect()->route('jobs.show', $job->id);


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
        $job = Job::find($id);
        return view('jobs.show')->with('job', $job);
    }


    public function edit($id)
    {
        //find the post and save as a varible
        //return the view

        $job = Job::find($id);
        $job_types = JobType::all();
        $type = array();
        foreach ($job_types as $job_type )

            $type[$job_type->id] = $job_type->type;
        return view('jobs.edit')->withJob($job)->withJob_types($type);
        //or return view('job.edit')->with('job',$job);
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

            'job_type_id' => 'required|max:255',
            'name' => 'required|max:255'

        ));
        //save date to database

        $job = Job::find($id);

        $job->job_type_id = $request->input('job_type_id');
        $job->name = $request->input('name');
        $job->description = $request->input('description');
        $job->save();


        //set flash message

        Session::flash('success', 'Job was updated');
        //redirect with flash date to show


        return redirect()->route('jobs.show', $job->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $job = Job::find($id);
       $job->delete();
        $job->contacts()->sync(array());
       Session::flash('success', 'The Job was successfully deleted');
       return redirect()->route('jobs.index');


    }
}
