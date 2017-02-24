<?php

namespace App\Http\Controllers;

use App\Role;
use Session;
use Illuminate\Http\Request;

use App\Http\Requests;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view('roles.index')->with('roles',$roles);
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
        $this->validate($request, array(

            'role' => 'required|unique:roles|max:255',



        ));

        //Store in the database

        $role = new Role;
        $role->role = $request->role;

        $role->save();

        Session::flash('success', 'The Role was successfully saved!');
        return redirect()->route('roles.index');





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
        //
        $role = Role::find($id);
        return view('roles.edit')->with('role',$role);


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
        $this->validate($request, array(

            'role' => 'required|unique:role|max:255',


        ));
        //save date to database

        $role = JobType::find($id);

        $role->role = $request->input('role');

        $role->save();


        //set flash message

        Session::flash('success', 'Role was updated');
        //redirect with flash date to show
        return redirect()->route('roles.index');
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
        $role = Role::find($id);
        $role->delete();
        Session::flash('success', 'The Role was successfully deleted');
        return redirect()->route('job_types.index');
    }
}
