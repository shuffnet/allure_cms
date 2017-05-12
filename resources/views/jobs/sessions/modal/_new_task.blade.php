<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="newTaskModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Task</h4>

                </div>
                <div class="modal-body">


                    <div class="row">



                        <div class="col col-md-8 ">

                          {{--************* Form goes here****************--}}
                            {!!Form::open(array('route' => 'task.store')) !!}

                            {{Form::text('session_date',$session->date, ['class'=>''])}}
                            {{Form::text('job_id',$job->id, ['class'=>''])}}
                            {{Form::text('created_by', Auth::user()->email, ['class'=>''])}}
                            {{Form::text('session_id',$session->id, ['class'=>''])}}



                            {{Form::label('task', 'Task Name:')}}
                            {{Form::text('task', null ,['class'=>'form-control']) }}
                            {{Form::label('task_status_id', 'Status:')}}

                            <select name="status" id="">
                                <option value="In Process">In Process</option>
                                <option value="Scheduled">Scheduled</option>
                                <option value="On Hold">On Hold</option>
                                <option value="Complete">Complete</option>
                            </select>


                            {{Form::label('contact_id', 'Assigned To:')}}
                            {{--{{Form::text('contact_id', $lead->id, ['class'=>'form-control'])}}--}}
                            <select name='contact_id'  class="form-control" >
                                <option selected="selected" value="{{$lead->id}}">{{$lead->fname}} {{$lead->lname}}</option>
                                @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->fname}} {{$employee->lname}}</option>
                                @endforeach
                            </select>
                            {{Form::checkbox('pin',1, false)}} {{Form::label('pin','Pin')}}<br>
                            {{Form::label('pin_reason', 'Pin Reason')}}
                            {{Form::text('pin_reason', null, ['class'=>'form-control'])}}

                            {{Form::label('notes', 'Notes')}}
                            {{Form::textarea('notes', null , ['class'=>'form-control'])}}

                            {{Form::label('dueDate', 'Due Date')}}
                            {{Form::date('dueDate', null, ['class'=>'form-control'])}}

                            {{Form::label('dueDateRules_id', 'Due Date Rules:')}}
                            {{Form::text('dueDateRulesTime', Null, ['class'=>'form-control'])}}


                            <select name="dueDateRules_id" class="form-control">
                                <option selected="selected" value="">Select</option>
                                <option value="1">Days Before Session</option>
                                <option value="2">Days After Session</option>
                                <option value="3">Days After Booked</option>

                            </select>

                            {{Form::label('startDateRules', 'Start Date Rules:')}}
                            {{--{{Form::text('startDateRulesTime', Null, ['class'=>'form-control'])}}--}}

                            {{--{{Form::select('startDateRules', [--}}

                                 {{--'1'=>'Days Before Session',--}}
                                 {{--'2'=>'Days After Session'--}}
                                {{--], Null, ['class'=>'form-control'])}}--}}

                            {{--{{Form::label('proccessTimeRules', 'Process Time Minutes')}}--}}
                            {{--{{Form::text('processTimeRules', Null, ['class'=>'form-control'])}}--}}
                            {{Form::submit('Save', ['class'=>'btn btn-primary'])}}


                            {!! Form::close() !!}



                        </div>
                    </div>
                </div>
                <div class="modal-footer">


                </div>
            </div>

        </div>
    </div>


</div>

