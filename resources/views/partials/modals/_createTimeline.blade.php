
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="createTimelineModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create New Time Line</h4>

                </div>
                <div class="modal-body">
                    {{$job->id}}
                    <div class="" id="newTimeline">
                        <div class="input-group">
                            <label for="name">Name:</label>
                            <input class="form-control" id="name" name="name" type="text">
                        </div>
                        <div class="input-group">
                            <label for="howMuchTime">Number of hours purchased:</label>
                            <input class="form-control" id="howMuchTime" name="howMuchTime" type="text">
                        </div>
                        <div class="input-group" >
                            <label for='ceremony-date'> Ceremony Date:</label>
                            <input class="form-control" value="2017-03-12" type='date' name='ceremony-date' id='ceremony-date-id'>


                        </div>
                        <div class="input-group" >
                            <label for='ceremony-time'> Ceremony Start Time:</label>
                            <input class="form-control" value="17:30" type='time' name='ceremony-time' id='ceremony-time-id'>


                        </div>
                        <div class="input-group">


                            <label for='ceremony-end-time'>Ceremony End Time:</label>
                            <input class="form-control"value="18:00"type='time' name='ceremony-end-time' id='ceremony-end-id'>



                        </div>



                    </div>

                </div>
                <div class="modal-footer">
                    <div id="btnSaveTimeline" class="btn btn-default ">Save</div>



                </div>
            </div>

        </div>
    </div>


</div>

