
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="add_shot_to_timeline_modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>


                </div>
                <div class="modal-body">
                    <div id="" class="col col-md-10 ">

                        <h3>Edit Group</h3>
                        <hr>
                        <form action="">

                            <input type="text" class="form-control" name="shotName">
                        </form>
                        {!! Form::model($shot, ['route'=>['shotList.update', $shot->id], 'method'=> 'PUT']) !!}


                        {{Form::label('name','Group Name:')}}
                        {{Form::text('name', null, array('class'=> 'form-control'))}}
                        <div id="shotbtn" class="btn btn-warning">Add Shots</div>
                        <table class="table">
                            @foreach ($shot->get_shots as $shotList)

                                <tr><td><a href="{{route('shotListDelete.delete', $shotList->id)}}" class="btn btn-link deleteShot">Delete</a></td><td>{{$shotList->id}}</td><td>{{$shotList->shot}}</td></tr>


                            @endforeach
                        </table>

                        <div id="wrapper"></div>


                        {{Form::label('tips','Tips:')}}
                        {{Form::textarea('tips', null, array('class'=> 'form-control'))}}
                        {{Form::label('time','How many minutes?')}}
                        {{Form::text('time', null, array('class'=> 'form-control'))}}




                        {{Form::submit('Update', array('class'=> 'btn btn-success btn-lg btn-block'))}}
                        {!! Form::close() !!}
                    </div>

                </div>
                <div class="modal-footer">
                    <div id="btnSaveTimeline" class="btn btn-default ">Save</div>



                </div>
            </div>

        </div>
    </div>


</div>








