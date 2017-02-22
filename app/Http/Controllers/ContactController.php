<?php

namespace App\Http\Controllers;

use App\Contact_Type;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contact;
use Session;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts = Contact::all();
        return view('contacts.index')->withContacts($contacts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $contact_types = Contact_Type::all();

        return view('contacts.create')->withContact_types($contact_types);
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
        dd($request);

        //Validate the data
        $this->validate($request, array(

            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required|max:255|email'

        ));


        //Store in the database

        $contact = new Contact;
        $contact->fname = $request->fname;
        $contact->lname = $request->lname;
        $contact->email = $request->email;

        $contact->save();
        $contact->contact_types()->sync($request->contact_type, false);

        Session::flash('success', 'The Contact was successfully saved!');
        return redirect()->route('contacts.show', $contact->id);





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
        $contact = Contact::find($id);
        return view('contacts.show')->with('contact', $contact);
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
        $contact = Contact::find($id);

        return view('contacts.edit')->withContact($contact);
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

            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required|max:255|email'

        ));
        //save date to database

        $job = Job::find($id);

        $job->job_type_id = $request->input('job_type_id');
        $job->name = $request->input('name');
        $job->description = $request->input('description');
        $job->save();
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
        $contact = Contact::find($id);
        $contact->delete();
        Session::flash('success', 'The Job was successfully deleted');
        return redirect()->route('contacts.index');

    }
}
