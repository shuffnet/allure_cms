<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Job_role;
use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\Contact_Type;

class AddMoreContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @return string
     */
    public function createMore($id)
   {
       $job = $id;

       $roles = Role::all();


       return view('add_contacts.create')->with('job', $job)->withRoles($roles);

   }
    public function create()
    {
//        return view('add_contacts.create');
//        return($id);\
        return'create';
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
        $this->validate($request, array(

            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required|max:255|email',
            'role' => 'required |max:255'

        ));


        //Store in the database
        $job = $request->id;
        $contact = new Contact;
        $contact->fname = $request->fname;
        $contact->lname = $request->lname;
        $contact->email = $request->email;
        $contact->phone = $request->phone;

        $contact->save();

        foreach ($request->role as $roleid){
            $role = $roleid;

        }
        $roles = new Job_role;
        $roles->job_id = $job;
        $roles->role_id = $role;
        $roles->contact_id = $contact->id;
        $roles->save();


        Session::flash('success', 'The Contact was successfully saved!');
        return redirect()->route('jobs.show', $job);




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
