<?php

namespace App\Http\Controllers;

use App\Contact_Type;
use App\Role;
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
        $roles = Role::all();

        return view('contacts.create')->withRoles($roles);
    }


    public function store(Request $request)
    {
        //


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
        $contact->phone = $request->phone;

        $contact->save();
        $contact->contact_type()->sync($request->contact_role, false);

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
        $contact_types = Contact_Type::all();
        $contact_type = array();
        foreach ($contact_types as $type){
            $contact_type[$type->id] = $type->type;

        }



        return view('contacts.edit')->withContact($contact)->withContact_type($contact_type);
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
        //save data to database

        $contact = Contact::find($id);

        $contact->fname = $request->input('fname');
        $contact->lname = $request->input('lname');
        $contact->email = $request->input('email');
        $contact->save();
        if (isset($request->contact_type)){

            $contact->contact_type()->sync($request->contact_type);

        } else{

           $contact->contact_type()->sync(array());
        }

        return redirect()->route('contacts.show', $contact->id);
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
        $contact->contact_type()->sync(array());
        Session::flash('success', 'The Contact was successfully deleted');
        return redirect()->route('contacts.index');

    }
}
