<?php

namespace App\Http\Controllers;

use App\ShotList;
use App\Timeline;
use App\TimelineGroup;
use App\TimelineGroupShot;
use Illuminate\Http\Request;

use App\Http\Requests;

class TimelineGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $groups = TimelineGroup::all();
        return view('timeline_group.index')->with('groups',$groups);

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
        $group = new TimelineGroup();
        $group->group = $request->group;
        $group->save();

        return redirect()->route('timelinegroup.show',['id' => $group->id]);
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
        $group = TimelineGroup::find($id);
        $shotList = ShotList::all();
        return view('timeline_group.show')
            ->withGroup($group)
            ->withShots($shotList);
    }
    public function addshot($groupId, $shotId)
    {
        $shot = new TimelineGroupShot();
        $shot->timelinegroup_id = $groupId;
        $shot->shot_list_id = $shotId;
        $shot->save();
        return redirect()->route('timelinegroup.show',['id' => $groupId]);

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
        $group = TimelineGroup::find($id);
        return view('timeline_group.edit')->withGroup($group);
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
        $group = TimelineGroup::find($id);
        $group->group = $request->group;
        $group->save();
        return redirect()->route('timelinegroup.index');

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
        $group = TimelineGroup::find($id);
        $group->delete();
        $group->getgroupshots()->sync(array());
        return redirect()->route('timelinegroup.index');
    }
}
