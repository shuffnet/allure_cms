<script type="text/javascript">

    var ceremonyStartTime = undefined;

    $(document).ready(function(){
        // *************************************************************************************

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // *************************************************************************************************

        $('#add-existing-contact').click(function(){

            var $lead = $("#photog option:selected").val();
            var $role = '1';
            var $job = '{{$job->id}}';
            var $token = "{{csrf_token()}}";

            $.ajax({
                url: '/job_role',
                type: 'POST',
                data: {
                    'contact_id': $lead,
                    'role_id': $role,
                    'job_id': $job,

                    success: function(data){
                        window.location.reload();
                    }
                }
            });
        });



        $('#btnSaveTimeline').on('click', function () {
            $('#workingtimeline').removeClass('hidden');
            var $timeline = $('#workingtimeline').html();
            var $hours = $('#timepurchased').text();
            var $job = '{{$job->id}}';



            $.ajax({
                url: '/jobtimeline',
                type: 'POST',
                data: {

                    'id':$job,
                    'timeline': $timeline,
                    'hours': $hours,
                    success: function(data) {
                        window.location.reload();
                    }
                }

            });
        });

        $('#btnClearTimeline').on('click', function () {
            var $timeline = "";
            var $job = '{{$job->id}}';
            var $token = "{{csrf_token()}}";

            $.ajax({
                url: '/jobtimeline',
                type: 'POST',
                data: {

                    'id':$job,
                    'timeline': $timeline,



                    success: function(data) {
                        window.location.reload();
                    }


                }



            });

        });
        $('#btnOpenTimeline').on('click', function () {
            $('#detail').removeClass('hidden');

        });

        $('#btnSaveTimeline2').on('click', function () {


            TableData = $.toJSON(storeTblValues());
            var $job = '{{$job->id}}';

            $.ajax({
                url: '/jobtimeline',
                type: 'POST',
                data:{
                    'data':TableData,
                    'jobId':$job,

                    },
                success: function(data){
                    // return value stored in msg variable
                    window.location.reload();



                }
            });



//                alert(storeTblValues()) ;


        });


        function storeTblValues()

        {
            var TableData = new Array();

            $('#timeline tr').each(function(row, tr){
                TableData[row]={
                    "duration" : $(tr).find('td:eq(2)').text()
                    , "time" :$(tr).find('td:eq(4)').text()
                    , "shot" : $(tr).find('td:eq(5)').text()
                    , "shots" : $(tr).find('td:eq(6)').html()
                    , "tips" : $(tr).find('td:eq(7)').text()

                }
            });
//                TableData.shift();  // first row will be empty - so remove
//                TableData = $.toJSON(TableData);

            return TableData;

        }







    });





    $('#btnStandard6').on('click', function () {


        var $jobDate = $('#ceremony-date-id').val();
        var $job = '{{$job->id}}';
        var $name = $('#name').val();




        $.ajax({
            url: '/timeline',
            type: 'POST',

            data: {

                'id':$job,
                'jobDate': $jobDate,
                'name': $name,


                },
                success: function(data) {
                    console.log(data);
//                    window.location.reload();
                    window.location.replace('/jobs/timeline/show/'+$job+'/'+data);
            }

        });

    });
    //      End of btnStandard6  *************************************************************************************************

    $('#btnCustomAdd').on('click', function () {
        ceremonyDate = $('#ceremony-date-id').val();
        ceremonyStartTime = $('#ceremony-time-id').val();
        ceremonyEndTime = $('#ceremony-end-id').val();
        howMuchTime = $('#howMuchTime').val();
        convertToMinutes = howMuchTime * 60;

        ceremonyDateTime = ceremonyDate + ',' + ceremonyStartTime;
        ceremonyEndDateTime = ceremonyDate + ','+ ceremonyEndTime;
        ceremonyStartDateTime = new Date(ceremonyDateTime);
        ceremonyEndDateTime = new Date(ceremonyEndDateTime);
        ceremonyStartShort = ceremonyStartDateTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
        ceremonyEndShort = ceremonyEndDateTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});


        var startTime = new Date(ceremonyStartDateTime);
        var endTime = new Date(ceremonyEndDateTime);
        var difference = endTime.getTime() - startTime.getTime(); // This will give difference in milliseconds
        var min = Math.round(difference / 60000);




        setup = subtractMinutes(ceremonyStartDateTime,15);
        setupHour = setup.getHours();
        setupMin = setup.getMinutes();
        setupTotal = setupHour +":"+ setupMin;
        setupShort = setup.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});

        pbreak = subtractMinutes(ceremonyStartDateTime,30);
        pbreakHour = pbreak.getHours();
        pbreakMin = pbreak.getMinutes();
        pbreakTotal = pbreakHour +":"+ pbreakMin;
        pbreakShort = pbreak.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});



        $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove  btn-link'>Remove</td><td class='addTime'>15</td><td>"+pbreakShort+"</td><td class='amount'>"+pbreakTotal+"</td><td>Photographers Break</td></tr>");

        $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove  btn-link'>Remove</td><td class='addTime'>15</td><td>"+setupShort+"</td><td class='amount'>"+setupTotal+"</td><td>Photographers Setup For Ceremony</td></tr>");

        $('#timeline').append("<tr style='color: #fff; background: lightblue;'><td class='edit btn-link' >Edit</td><td class='remove  btn-link'>Remove</td><td class='addTime'>"+min+"</td><td>"+ceremonyStartShort+"</td><td class=''>"+ceremonyStartTime+"</td><td> Ceremony Start Time</td></tr>");
        $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove  btn-link'>Remove</td><td class='addTime'>5</td><td>"+ceremonyEndShort+"</td><td class='amount'>"+ceremonyEndTime+"</td><td> Ceremony End Time</td></tr>");



        var minutes = $('tr:last td:first').text();
        var time = $('tr:last td:nth-child(3)').text();
//              alert(minutes+','+time);

        $('#createTimelineModal').modal('hide');
        $('#timelineshots').removeClass('hidden');
        $('#timelinesection').removeClass('hidden');

        calculateMin();
        $('#purchased').html("Purchased "+convertToMinutes);
    });

    $('#shotListTable .addPost').on('click',function(){
        var $row = $(this).closest("tr");       // Finds the closest row <tr>
        $minutes = $row.find("td:nth-child(2)").text();
        $shot =  $row.find("td:nth-child(3)").text();
        $shots = $row.find("td:nth-child(4)").html();
        $tips = $row.find("td:nth-child(5)").text();

        setDate = $('#ceremony-date-id').val();
        setStartTime = $('#timeline tr:last td:nth-child(5)').text();
        setShotTime = $('#timeline tr:last td:nth-child(3)').text();

        setDateTime = setDate + ',' + setStartTime;
        setDateTime = new Date(setDateTime);
        setNewTime = addMinutes(setDateTime, setShotTime);

        shortHour = setNewTime.getHours();
        shortMin = setNewTime.getMinutes();
        longTime = shortHour +":"+ shortMin;
        shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});

        $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class='hidden'>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
        $row.addClass('hidden');
        $row2 = $(this).closest('tr').next('tr');
        $row3 = $row2.next('tr');
        $row2.addClass('hidden');
        $row3.addClass('hidden');
        calculateMin()

    });


    $('#shotListTable .addPre').on('click',function() {
        $row = $(this).closest("tr");       // Finds the closest row <tr>
        $minutes = $row.find("td:nth-child(2)").text();
        $shot = $row.find("td:nth-child(3)").text();
        $shots = $row.find("td:nth-child(4)").html();
        $tips = $row.find("td:nth-child(5)").text();
        setDate = $('#ceremony-date-id').val();
        setStartTime = $('#timeline tr:first td:nth-child(4)').text();
        setShotTime = $('#timeline tr:first td:nth-child(2)').text();
        setDateTime = setDate + ',' + setStartTime;
        setDateTime = new Date(setDateTime);
        setNewTime = subtractMinutes(setDateTime, $minutes);

        shortHour = setNewTime.getHours();
        shortMin = setNewTime.getMinutes();
//            24hr Time
        longTime = shortHour + ":" + shortMin;
//            12hr time
        shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'});

        $('#timeline').prepend("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class='hidden'>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");


        //This hides the hidden colapsed rows

        $row.addClass('hidden');
        $row2 = $(this).closest('tr').next('tr');
        $row3 = $row2.next('tr');
        $row2.addClass('hidden');
        $row3.addClass('hidden');
        calculateMin()
    });
    $('#custPre').on('click', function () {

        $minutes = $( "input[name='custTime']" ).val();
        $shot = $( "input[name='custShot']" ).val();
        $shots = $("#custShotsList").val();
        $tips = $("#custShotTips").val();

        setDate = $('#ceremony-date-id').val();
        setStartTime = $('#timeline tr:first td:nth-child(5)').text();
        setShotTime = $('#timeline tr:first td:nth-child(3)').text();


        setDateTime = setDate + ',' + setStartTime;
        setDateTime = new Date(setDateTime);
        setNewTime = subtractMinutes(setDateTime, $minutes);

        shortHour = setNewTime.getHours();
        shortMin = setNewTime.getMinutes();
        longTime = shortHour + ":" + shortMin;
        shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute: '2-digit'});
        $('#timeline').prepend("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class='hidden'>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
        $('#custShotForm').trigger("reset");
        $('#custShotsList').val("");
        $('#custShotModal').modal('hide');
        calculateMin()

    });
    $('#custPost').on('click', function () {

        $minutes = $( "input[name='custTime']" ).val();
        $shot = $( "input[name='custShot']" ).val();
        $shots = $("#custShotsList").val();
        $tips = $("#custShotTips").val();



        setDate = $('#ceremony-date-id').val();
        setStartTime = $('#timeline tr:last td:nth-child(5)').text();
        setShotTime = $('#timeline tr:last td:nth-child(3)').text();


        setDateTime = setDate + ',' + setStartTime;
        setDateTime = new Date(setDateTime);
        setNewTime = addMinutes(setDateTime, setShotTime);

        shortHour = setNewTime.getHours();
        shortMin = setNewTime.getMinutes();
        longTime = shortHour +":"+ shortMin;
        shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});

        $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot+"</td><td class='hidden'>"+$shots+"</td><td class='hidden'>"+$tips+"</td></tr>");
        $('#custShotForm').trigger("reset");
        $('#custShotsList').val("");
        $('#custShotModal').modal('hide');
        calculateMin()


    });


    //        This is the edit link on the timeline table

    $('body').on('click', '.edit', function() {
        ceremonyStartTimeRow = $("tr:contains('Ceremony Start')");
        ceremonyStartTime = ceremonyStartTimeRow.find("td:nth-child(5)").text();
        $row_index = $(this).parent().index();
        $("#myModal").modal("show");
        $shot = $(this).parent().find("td:nth-child(6)").text();
        $time = $(this).parent().find("td:nth-child(3)").text();
        $shots = $(this).parent().find("td:nth-child(7)").text();
        $tips = $(this).parent().find("td:nth-child(8)").text();
        setStartTime = $(this).parent().find("td:nth-child(5)").text();
        $('#shot').val($shot);
        $('#time').val($time);
        $('#shots').val($shots);
        $('#tips').val($tips);
        $('#id').val($row_index);
        $(this).parent().remove();


    });
    //        This is the save button on the shot edit modal
    $('#editModal').on('click', function(){

        //            add row to the table

        i = $('#id').val();

        $nextRow = i+1;
        $prevRow = i-1;
        $minutes = $('#time').val();
        $shot2 =  $('#shot').val();
        setDate = $('#ceremony-date-id').val();
        $shots2 = $('#shots').val();
        $tips = $('#tips').val();


//This appends to after ceremony

        if (ceremonyStartTime >= setStartTime)
        {
            setStartTime = $('#timeline tr:eq('+i+') td:nth-child(5)').text();

            setShotTime = $('#time').val();
            setDateTime = setDate + ',' + setStartTime;
            setDateTime = new Date(setDateTime);
            setNewTime = subtractMinutes(setDateTime, setShotTime);

        }else{
//This prepends before ceremony
            setStartTime = $('#timeline tr:eq('+$prevRow+') td:nth-child(5)').text();


            setShotTime = $('#timeline tr:eq('+$prevRow+') td:nth-child(3)').text();
            setDateTime = setDate + ',' + setStartTime;
            setDateTime = new Date(setDateTime);

            setNewTime = addMinutes(setDateTime, setShotTime);

        }
//            setNewTime = addMinutes(setDateTime, setShotTime);

        shortHour = setNewTime.getHours();
        shortMin = setNewTime.getMinutes();
        longTime = shortHour +":"+ shortMin;
        shortTime = setNewTime.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
        html = "<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class='addTime'>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot2+"</td><td class=''>"+$shots2+"</td><td class='hidden'>"+$tips+"</td></tr>";



        if (i == 0) {
            i = 0;
            $('#timeline > tbody >tr:eq('+i+')').before(html);
        }else{
            i = i-1;
            $('#timeline > tbody >tr:eq('+i+')').after(html);
        }



//            $('#timeline').append("<tr><td class='edit btn-link' >Edit</td><td class='remove btn btn-link'>Remove</td><td class=''>"+$minutes+"</td><td>"+shortTime+"</td><td class=''>"+longTime+"</td><td>"+$shot2+"</td><td class='hidden'>"+$shots2+"</td><td class='hidden'>"+$tips+"</td></tr>");
//            $('#timeline').append("<tr><td colspan='4'><ul>"+$shots+"</ul></td></tr>");

        $('#myModal').modal('hide');
        calculateMin()
    });

    //    Removes row from dynamic table

    $('body').on('click', '.remove', function() {
        $(this).parent().remove();
        calculateMin()
    });


    //function to add minutes to get the next shots time

    function addMinutes(date, minutes) {

        return new Date(date.getTime() + minutes*60000);
    }
    //function to subtracts minutes to get the next shots time

    function subtractMinutes(date, minutes) {

        return new Date(date.getTime() - minutes*60000);


    }


    //        Creates Datatables plugin tables

    //        $(document).ready(function(){
    //            $('.tableDisplay').DataTable();
    //            ({
    //
    //                searching: false,
    //                paging: false,
    //                info:     false
    //            });
    //            $('#timeline').DataTable();

    //        });

    //        This adds shots to the list on the custom shots page

    $('#custShotBtn').on('click', function(){
        var $shots = $('#custShotsList').val();
        var $shot = $('#custShots').val();
        $('#custShotsList').val($shots+"<li>"+$shot+"</li>");
        $('#custShots').val('');



    });

    //        This shows the custom shots page
    $('#custModalBtn').on('click', function () {


        $("#custShotModal").modal("show");

    });

    //        This closes and clears the form for the custom shots page
    $('#closeCustModal').on('click', function () {

        $('#custShotForm').trigger("reset");
        $('#custShotsList').val("");
        $('#custShotModal').modal('hide');
    })

    $('#btnCreateTimeline').on('click', function () {

        $("#createTimelineModal").modal("show");

    })
    $('#btntimeline').on('click', function () {
        $('#timelinesection').removeClass('hidden');
        $('#overviewsection').addClass('hidden');
    })
    $('#btnhome').on('click', function () {
        $('#overviewsection').removeClass('hidden');
        $('#timelinesection').addClass('hidden');
    })

    function calculateMin() {


        var sum = 0;

        $('.addTime').each(function()
        {


            sum += parseInt($(this).text());
            total = sum ;

        });

        $('#totaltime').html("You have used "+sum);




    }











</script>