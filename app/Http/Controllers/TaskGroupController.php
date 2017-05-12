<?php

namespace App\Http\Controllers;

use App\TaskGroup;

use App\Taskgroup_taskitem;
use App\TaskItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class TaskGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $groups = TaskGroup::all();
        return view('taskgroup/create')->withGroups($groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $groups = TaskGroup::all();
        return view('taskgroup/create')->withGroups($groups);
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
        $group = New TaskGroup();
        $group->group = $request->group;
        $group->save();
        return redirect()->route('taskgroup.show', $group->id);

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
        $group = TaskGroup::find($id);
        $task = TaskItem::all();

        return view('taskgroup/show')
            ->withGroup($group)
            ->withTasks($task);

    }

    public function addtask(Request $request)
    {
        $groupitem = new Taskgroup_taskitem();

        $groupitem->taskgroup_id = $request->taskgroup_id;
        $groupitem->taskitems_id = $request->taskitems_id;
        $groupitem->save();


        return Redirect::back();





    }
    public function destroytask($id)
    {
       $task = Taskgroup_taskitem::find($id);
       $task->delete();
        return Redirect::back();


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
        $group = TaskGroup::find($id);
        $group->delete();
        return redirect()->route('taskgroup.create');
    }
}
