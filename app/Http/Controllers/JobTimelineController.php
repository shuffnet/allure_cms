<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Job;
use App\JobTimelineShots;
use App\ShotList;
use App\Timeline;
use App\TimelineGroup;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\JobTimelineDetails;


use App\Http\Requests;

class JobTimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jobTimelineCreate($jobId,$timelineId)
    {
        $timeline = Timeline::find($timelineId);

        $job = Job::find($jobId);
        $photogs = Contact::whereHas('contact_type', function($q) {
            $q->where('role', '=', 'Lead photographer');
        })->get();

        $lead = DB::table('job_role')
            ->where('job_id', '=', $job->id)
            ->where('role_id', '=', 1)
            ->join('contacts','job_role.contact_id' ,'=','contacts.id')
            ->first();

        $shotList = ShotList::all();

        $contacts = DB::table('job_role')
            ->leftJoin('contacts', 'job_role.contact_id', '=', 'contacts.id')
            ->join('roles', 'job_role.role_id', '=', 'roles.id')
            ->where('job_id', '=', $job->id)
            ->select('*','job_role.id')
            ->orderBy('role', 'asc')
            ->get();
        $timelinegroup = TimelineGroup::all();

//

        return view('jobs.timeline.Timeline_items.create')
            ->with('job', $job)
            ->withContacts($contacts)
            ->withPhotogs($photogs)
            ->withLead($lead)
            ->withShots($shotList)
            ->withTimeline($timeline)
            ->withTimelinegroup($timelinegroup)
//
            ;

    }
    public function jobTimelineShow($jobId,$timelineId)
    {
        $timeline = Timeline::find($timelineId);

        $job = Job::find($jobId);
        $photogs = Contact::whereHas('contact_type', function($q) {
            $q->where('role', '=', 'Lead photographer');
        })->get();

        $lead = DB::table('job_role')
            ->where('job_id', '=', $job->id)
            ->where('role_id', '=', 1)
            ->join('contacts','job_role.contact_id' ,'=','contacts.id')
            ->first();

        $shotList = ShotList::all();

        $contacts = DB::table('job_role')
            ->leftJoin('contacts', 'job_role.contact_id', '=', 'contacts.id')
            ->join('roles', 'job_role.role_id', '=', 'roles.id')
            ->where('job_id', '=', $job->id)
            ->select('*','job_role.id')
            ->orderBy('role', 'asc')
            ->get();


//

        return view('jobs.timeline.show')
            ->with('job', $job)
            ->withContacts($contacts)
            ->withPhotogs($photogs)
            ->withLead($lead)
            ->withShots($shotList)
            ->with('timeline',$timeline)

//
            ;


    }
    public function jobTimelineIndex($id){

//
        $job = Job::find($id);
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

//

        return view('jobs.timeline.index')
            ->with('job', $job)
            ->withContacts($contacts)
            ->withPhotogs($photogs)
            ->withLead($lead)

//
            ;

    }
    public function index()
    {
        //
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
    public function jobTimelineAddShot($jobid, $timelineId, $shotid)
    {

        $shot = ShotList::find($shotid);
        return view('jobs.timeline.Timeline_items.addShot')
            ->withShot($shot)
            ->withJob($jobid)
            ->withTimeline($timelineId)
            ;



    }

    public function store(Request $request)
    {
        $this->validate($request, array(

            'pre' => 'required|max:255',

        ));

        $job = $request->job_id;
        $timelineID = $request->timeline_id;
        $duration = $request->duration;
        $pre = $request->pre;

                if ($pre == 1){

                    $lastShot = DB::table('jobtimelineshots')

                        ->where('timeline_id', '=', $timelineID)
                        ->orderBy('time', 'asc')->first();

                    $shotTime = (new Carbon($lastShot->time))->subMinutes($duration)->format('H:i ');

                } else{

                    $lastShot = DB::table('jobtimelineshots')

                        ->where('timeline_id', '=', $timelineID)
                        ->orderBy('time', 'desc')->first();
                    $shotTime = (new Carbon($lastShot->time))->addMinutes($lastShot->duration)->format('H:i ');

                }


        $shot = new JobTimelineShots();
        $shot->timeline_id = $timelineID;
        $shot->time = $shotTime;
        $shortDate = new DateTime($shotTime);
        $shot->shot = $request->name;
        $shot->shortTime = $shortDate->format('g:i a') ;
        $shot->duration = $request->duration;
        $shot->save();


        $shots = $request->shots;
        if (isset($shots)) {

            foreach ($shots as $detail) {
                $details = new JobTimelineDetails();
                $details->detail = $detail;
                $details->jobtimelineshots_id = $shot->id;
                $details->save();
                unset($detail);
            }

        }


        return redirect()->route('job_timeline.jobtimelineCreate', ['jobid' => $job, 'timelineId'=> $timelineID]);





    }
    public function addbygroup($timelineID, $groupID, $jobID)
    {


        $group = TimelineGroup::find($groupID);
        $timeline = Timeline::find($timelineID);
        $timeline->jobDate;
       $ceremonyTime = $timeline->ceremonyTime;
       $ceremonyTime = (new Carbon($ceremonyTime))->format('H:i');
        $timeline->ceremonyEndTime;
       $timepurchased = $timeline->duration;
       if ($timepurchased >= 8){
           $startTime = (new Carbon($ceremonyTime))->subMinutes(180)->format('H:i ');
       }
       if ($timepurchased < 8){
           $startTime = (new Carbon($ceremonyTime))->subMinutes(120)->format('H:i ');
       }

        echo($timepurchased."<br>");
        echo($startTime."<br>");
        echo ($ceremonyTime."<br>");
//        echo('<table>');
        $duration = 0;
        $lastShot = $startTime;
        $shotTime = (new Carbon($lastShot))->addMinutes($duration)->format('H:i') ;

        foreach($group->getgroupshots->sortBy('pivot.id') as $groupshot)
        {
            $shot = new JobTimelineShots();
            $shot->timeline_id = $timelineID;
            $shot->time = $shotTime;
            $shortDate = new DateTime($shotTime);
            $shot->shot = $groupshot->name;
            $shot->shortTime = $shortDate->format('g:i a') ;
            $shot->duration = $groupshot->time;

            $shot->tips = $groupshot->tips;
            $shot->save();
//            echo('<tr><td>'.(new Carbon($shotTime))->format('g:i') . '</td><td>'." ". $shot->name.'</td><td>'.$shot->time.'</td></tr>');
            $lastShot = $shotTime;
            $shotTime = (new Carbon($lastShot))->addMinutes($groupshot->time)->format('H:i');

                $details = $groupshot->get_shots;

                foreach ($details as $detail) {

                    $details = new JobTimelineDetails();
                    $details->detail = $detail->shot;
                    $details->jobtimelineshots_id = $shot->id;
                    $details->save();
                    unset($detail);
                }

          unset($groupshot);

        }
//        echo('</table>');

        return redirect()->route('job_timeline.jobtimelineCreate', ['jobid' => $jobID, 'timelineId'=> $timelineID]);



    }



    public function clearallshots($jobID,$timelineID)
    {
        $shots = JobTimelineShots::where('timeline_id',$timelineID)->get();
           foreach ($shots as $shot)
           {
               $shot->delete();
               $shot->get_details()->delete();
           }
        return redirect()->route('job_timeline.jobtimelineCreate', ['jobid' => $jobID, 'timelineId'=> $timelineID]);

    }





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
