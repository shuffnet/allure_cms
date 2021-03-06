<?php

namespace App\Http\Controllers;

use App\Session_Type;
use App\TaskGroup;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class Session_Type_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $types = Session_Type::all();
        $groups = TaskGroup::all();
        return view('session_type.index')
            ->withGroups($groups)
            ->withTypes($types);
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
        $type = new Session_Type();
        $type->type = $request->type;
        $type->save();
        if($request->taskgroup)
        {
            $type->get_taskgroup()->sync($request->taskgroup, false);
        }

        return redirect()->route('session_type.index');

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
       $session_type = Session_Type::find($id);
       $group = TaskGroup::all();
       return view('session_type.show')
           ->withType($session_type)
           ->withGroups($group);

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
        $type = Session_Type::find($id);
        $type->type = $request->type;
        $type->save();
        if($request->taskgroup)
        {
            $type->get_taskgroup()->sync($request->taskgroup);
        }

        return redirect()->route('session_type.index');
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
        $type = Session_Type::find($id);
        $type->delete();
        $type->get_taskgroup()->sync(array());
        return Redirect::back();

    }
}
