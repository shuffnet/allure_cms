<?php

namespace App\Http\Controllers;

use App\JobTimelineShots;
use App\Timeline;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;

class TimelineController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTimeline($id)
    {
        //
//        return $id;
        return view('jobs.timeline.create')
            ->withJob($id);
    }
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {
        //
        $jobDate = $request->jobDate;
        $job_id = $request->job_id;
        $name = $request->name;
        $time = $request->ceremonytime;


        $timeline = new Timeline;
        $timeline->job_id = $job_id;
        $timeline->jobDate =$jobDate;
        $timeline->name = $name;
        $timeline->save();
        $id = $timeline->id;

        $shot = new JobTimelineShots();
        $shot->timeline_id = $id;

        $shot->shot = "Ceremony";

        $shot->save();


        return redirect()->route('job_timeline.jobtimelineCreate', ['jobid' => $job_id, 'timelineId'=> $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $timeline = Timeline::find($id);

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
        $timeline = Timeline::find($id);
        $timeline->delete();
//        $job->role()->sync(array());
        Session::flash('success', 'The Timeline was successfully deleted');

        return Redirect::back();
    }
}
