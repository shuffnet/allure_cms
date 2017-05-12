<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Job;
use App\Session;
use App\Session_Type;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class JobSessionsController extends Controller
{
    //
    public function getsessions($id)
    {
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

        return view('jobs.sessions.index')
            ->with('job', $job)
            ->withContacts($contacts)
            ->withPhotogs($photogs)
            ->withLead($lead)

//
            ;

    }
    public function createsession ($jobID, $photogID)
    {
        $session_types = Session_Type::all();
        $photogs = Contact::whereHas('contact_type', function($q) {
            $q->where('role', '=', 'Lead photographer');
        })->get();

        return view('jobs.sessions.create')
            ->withJob($jobID)
            ->withLead($photogID)
            ->withPhotogs($photogs)
            ->withSession_types($session_types)



            ;
    }

    public function showsession($id, $session_id)
    {
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
        $session = Session::find($session_id);

        $employees =DB::table('contact_role')

            ->where('role_id', '=', 5)
            ->join('contacts','contact_role.contact_id' ,'=','contacts.id')
            ->get();

//

        return view('jobs.sessions.show')
            ->with('job', $job)
            ->withContacts($contacts)
            ->withPhotogs($photogs)
            ->withLead($lead)
            ->withSession($session)
            ->withEmployees($employees)

//
            ;

    }
}
