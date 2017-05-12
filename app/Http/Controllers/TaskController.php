<?php

namespace App\Http\Controllers;

use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class TaskController extends Controller
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
        $task = New Task();
        $task->job_id = $request->job_id;
        $task->session_id = $request->session_id;
        $task->task = $request->task;
        $task->status = $request->status;
        $task->contact_id = $request->contact_id;
        $task->pinned = $request->pin;
        $task->pin_reason = $request->pin_reason;
        $task->notes = $request->notes;
        $task->dueDateRules_id = $request->dueDateRules_id;
        $task->dueDateRulesTime = $request->dueDateRulesTime;
        $task->created_by = $request->created_by;

        $dueDate = $request->dueDate;
        if ($dueDate){

            $task->date = $request->dueDate;

        }else{
//            '1'=>'Days Before Session',
//            '2'=>'Days After Session'
            if ($request->dueDateRules_id == 1){
                $dueDate = new Carbon($request->session_date);
                $dueDate = $dueDate->subDays($request->dueDateRulesTime);
                $task->dueDate = $dueDate;
            }
            if ($request->dueDateRules_id == 2){
                $dueDate = new Carbon($request->session_date);
                $dueDate = $dueDate->addDays($request->dueDateRulesTime);


                $task->dueDate = $dueDate;


            }

//
        }
        $task->save();










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
