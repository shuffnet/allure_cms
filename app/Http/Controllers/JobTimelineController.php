<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Job;
use App\JobTimelineShots;
use App\ShotList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;


use App\Http\Requests;

class JobTimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jobTimelineShow($jobId,$timelineId)
    {
//        $timeline = Timeline::find($id);

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
    public function store(Request $request)
    {

        $job = $request->jobId;

        // Unescape the string values in the JSON array
        $tableData = stripcslashes($request->data);

        // Decode the JSON array
        $tableData = json_decode($tableData,TRUE);
        foreach ($tableData as $row){
           $duration = $row{'duration'};
           $time = $row{'time'};
           $shot = $row{'shot'};
//           $shots = $row{'shots'};

           $tips = $row{'tips'};
           $shots =  htmlspecialchars($row{'shots'}, ENT_QUOTES);

            $timeline = new JobTimelineShots;

           $timeline->job_id = $job;
            $timeline->time = $time;
            $timeline->duration = $duration;
            $timeline->shot = $shot;
            $timeline->shots = $shots;
            $timeline->tips = $tips;
            $timeline->save();

        }
        Session::flash('success', $job);
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
