<?php

namespace App\Http\Controllers;

use App\JobTimelineShots;
use App\Timeline;

use App\TimelineGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
use DateTime;

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
        $starttime = $request->ceremonytime;
        $endtime = $request->ceremonyendtime;
        $duration = $request->howMuchTime;


        $timeline = new Timeline;
        $timeline->job_id = $job_id;
        $timeline->jobDate =$jobDate;
        $timeline->name = $name;
        $timeline->ceremonyTime = $starttime;
        $timeline->ceremonyEndTime = $endtime;
        $timeline->duration = $duration;
        $timeline->save();
        $id = $timeline->id;
//        Sets Ceremony
//        $shot = new JobTimelineShots();
//        $shot->timeline_id = $id;
//        $shot->time = $starttime;
//        $shot->duration = ( strtotime($endtime) - strtotime($starttime) ) / 60;
//        $shortDate = new DateTime($starttime);
//        $shot->shortTime = $shortDate->format('g:i a') ;
//        $shot->shot = "Ceremony";
//        $shot->save();
//        Sets Ceremony End
//        $shot = new JobTimelineShots();
//        $shortDate = new DateTime($endtime);
//        $shot->timeline_id = $id;
//        $shot->time = $endtime;
//        $shot->shot = "Ceremony Recessional";
//        $shot->shortTime = $shortDate->format('g:i a') ;
//        $shot->duration = "5";
//        $shot->save();

//        Photographers setup for ceremony

//        $shot = new JobTimelineShots();
//
//        $shotTime = (new Carbon($starttime))->subMinutes(30)->format('H:i ');
//        $shot->timeline_id = $id;
//        $shot->time = $shotTime;
//        $shortDate = new DateTime($shotTime);
//
//        $shot->shot = "Photographers Setup For Ceremony";
//        $shot->shortTime = $shortDate->format('g:i a') ;
//        $shot->duration = "30";
//        $shot->save();



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



        foreach ($timeline->timeline_shots as $shots)
        {
            $shots->get_details()->delete();
        }



        $timeline->delete();
        $timeline->timeline_shots()->delete();



        Session::flash('success', 'The Timeline was successfully deleted');

        return Redirect::back();
    }
}
