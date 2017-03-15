
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="custShotModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>

                </div>
                <div class="modal-body">

                    <div class="col col-md-8 ">
                        <form id="custShotForm" action="">

                            <label for="custShot">Shot:</label>
                            <input name="custShot" type="text" class="form-control">
                            <label for="custTime">Time/Minutes:</label>
                            <input name="custTime" type="text" class="form-control">
                            <input type="text" id="custShots">
                        <div id="custShotBtn" class="btn btn-default">Add</div>
                            <textarea name="custShotsList" id="custShotsList" cols="50" rows="10"></textarea>
                            <label for="tips">Tips:</label>
                            <textarea name="custShotTips" id="custShotTips" cols="50" rows="10"></textarea>

                            <div id="custPre" class="btn btn-default">Pre</div>
                            <div id="custPost" class="btn btn-default">Post</div>
                            <div id="closeCustModal" class="btn btn-default">Close</div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">


                </div>
            </div>

        </div>
    </div>


</div>

