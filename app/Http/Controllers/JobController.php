<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Contact_Type;
use App\Job;
use App\Job_role;
use App\JobType;
use App\OrderType;
use App\Role;
use App\ShotList;
use App\Timeline;
use Illuminate\Support\Facades\DB;
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
        $contact->phone = $request->phone;

        $contact->save();

        $job = new Job;
        $job->job_type_id = $request->job_type_id;
        $job->name = $request->name;
        $job->date = $request->date;
        $job->description = $request->description;
        $job->client_id = $contact->id;

        $job->save();

        foreach ($request->role as $roleid){
            $role = $roleid;

        }
        $roles = new Job_role;
        $roles->job_id = $job->id;
        $roles->role_id = $role;
        $roles->contact_id = $contact->id;
        $roles->save();

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
        $order_types = OrderType::all();
        $job = Job::find($id);
        $timelines = DB::table('timelines')->where('job_id', $id)->get();




        $photogs = Contact::whereHas('contact_type', function($q) {
            $q->where('role', '=', 'Lead photographer');
        })->get();

        $lead = DB::table('job_role')
            ->where('job_id', '=', $job->id)
            ->where('role_id', '=', 1)
            ->join('contacts','job_role.contact_id' ,'=','contacts.id')
            ->first();



        $contacts = DB::table('job_role')
            ->leftJoin('contacts', 'job_role.contact_id', '=', 'contacts.id')
            ->join('roles', 'job_role.role_id', '=', 'roles.id')
            ->where('job_id', '=', $job->id)
            ->select('*','job_role.id')
            ->orderBy('role', 'asc')
            ->get();

        $shotList = ShotList::all();
        $orders = DB::table('orders')

            ->where('job_id', "=", $job->id)
            ->join('contacts', 'orders.contact_id', '=', 'contacts.id')
            ->join('order_types','orders.orderType_id', '=', 'order_types.id')
            ->select('orders.id', 'contacts.fname', 'contacts.lname', 'order_types.type', 'orders.orderDate')



            ->get();

        return view('jobs.show')
            ->with('job', $job)
            ->withContacts($contacts)
            ->withPhotogs($photogs)
            ->withLead($lead)
            ->withOrder_types($order_types)
            ->withOrders($orders)
            ->withShots($shotList)
            ->withTimelines($timelines);
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
        $job->role()->sync(array());
       Session::flash('success', 'The Job was successfully deleted');
       return redirect()->route('jobs.index');


    }


}
