<?php

namespace App\Http\Controllers;

use App\Default_config;
use App\Session;
use App\Session_Type;
use App\Task;
use App\TaskGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SessionController extends Controller
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
        $session = new Session();
        $session->session_type_id = $request->session_type_id;
        $session->date = $request->date;
        $session->time = $request->time;
        $session->notes = $request->notes;
        $session->photographer_id = $request->photographer_id;
        $session->location = $request->location;

        $session->job_id = $request->job_id;

            $customer = DB::table('job_role')
                ->where('job_id', '=', $request->job_id)
                ->where('role_id', '=', 2)
                ->join('contacts','job_role.contact_id' ,'=','contacts.id')
                ->first();

        $sessiontype = Session_type::find($request->session_type_id);

        $session->imagepath = $customer->fname.'_'.$customer->lname.'_'.$sessiontype->type.'_'.$request->date;


        $session->save();
        $sessiontype = Session_Type::find($session->session_type_id);

        $custserve = DB::table('job_role')
            ->leftJoin('contacts', 'job_role.contact_id', '=', 'contacts.id')
            ->join('roles', 'job_role.role_id', '=', 'roles.id')
            ->where('job_id', '=', $request->job_id)
            ->where('role_id', '=', 6 )
            ->select('*','job_role.id')
            ->orderBy('role', 'asc')
            ->first();


//        foreach ($sessiontype->get_taskgroup()->getRelatedIds() as $group)
            foreach ($sessiontype->get_taskgroup as $group)
        {

            foreach ($group->get_task as $tasks)
            {
                $task = new Task();
                $task->job_id = $session->job_id;
                $task->session_id = $session->id;
                $task->task = $tasks->task;
                $task->status = "Scheduled";

                if ($tasks->assigned_to == 1)
                {
                    $task->contact_id = $session->photographer_id;

                }
                if ($tasks->assigned_to == 2)
                {

                    $task->contact_id = $custserve->contact_id;


                }



                    if ($tasks->dueDateRules_id == 1){
                        $dueDate = new Carbon($session->date);
                        $dueDate = $dueDate->subDays($tasks->dueDateRulesTime);
                        $task->dueDate = $dueDate;

                    }

                    if ($tasks->dueDateRules_id == 2){
                        $dueDate = new Carbon($session->date);
                        $dueDate = $dueDate->addDays($tasks->dueDateRulesTime);


                        $task->dueDate = $dueDate;

                    }

                    if ($tasks->dueDateRules_id == 3){
                        $dueDate = new Carbon($session->created_at);
                        $dueDate = $dueDate->addDays($tasks->dueDateRulesTime);
                        $task->dueDate = $dueDate;


                    }
                $task->save();
            }
        }




       return redirect()->route('jobsSessions.show',['jobID'=>$session->job_id, 'sessionID'=> $session->id] );


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
        $session = Session::find($id);
        $session->delete();

        foreach ($session->get_task as $task)
        {
            $task->delete();
        }
        return Redirect::back();
    }
}
