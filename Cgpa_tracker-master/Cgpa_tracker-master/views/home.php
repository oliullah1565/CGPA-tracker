<div class="container-fluid">
    
    <!-- submit id -->
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="form-label">Submit Id :</div>
                <input type="text" name="studentId" class="form-control">
                <input id="btn_submit_id" type="submit" class="btn" >
            </div>
        </div>
    </div>
    <br>
    <!-- student details -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Your student details</h3>
                </div>
                <div class="card-body">
                    <label > Name :</label>
                    <label id="student_name" ></label>
                    <br>
                    <label >Program :</label>
                    <label id="student_program" ></label>
                    <br>
                    <label>Batch :</label>
                    <label id="student_batch" ></label>
                    <br>
                    <label>Enrollment :</label>
                    <label id="student_enrollment" ></label>
                    <br>
                    <label>Total Required Credit :</label>
                    <label id="student_credit" ></label>
                </div>
            </div>
        </div>
    </div>

    <!-- Last Semester Result -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Your Last Semester Result</h3>
                </div>
                <div class="card-body">
                    <div id="last"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
//page name
document.getElementById('page_name').innerHTML = 'Home';

var studentId= <?php session_start();
    if(isset($_SESSION['studentId']))
    echo "'".$_SESSION['studentId']."'";
    else {
        echo "'not found'";
    }
    ?>;
    if(studentId!='not found')
    {
        $.ajax({
        url: '../controllers/HomeController.php',
        method: 'post',
        dataType:"json",
        data: {studentId : studentId},
        success: function (mgs) {
            $('#student_name').html(mgs.name);
            $('#student_program').html(mgs.program);
            $('#student_batch').html(mgs.batch);
            $('#student_enrollment').html(mgs.enrollment);
            $('#student_credit').html(mgs.total_credit);
            }
        });

        $.ajax({
            url: '../controllers/HomeController.php',
            method: 'get',
            data: {studentId : studentId},
            success: function (mgs) {
                $('#last').html(mgs);
            }
        });
    }

$("#btn_submit_id").click(function(e){
    e.preventDefault();
    
    studentId =document.getElementsByName('studentId')[0].value;
     
    $.ajax({
        url: '../controllers/HomeController.php',
        method: 'post',
        dataType:"json",
        data: {studentId : studentId},
        success: function (mgs) {
            $('#student_name').html(mgs.name);
            $('#student_program').html(mgs.program);
            $('#student_batch').html(mgs.batch);
            $('#student_enrollment').html(mgs.enrollment);
            $('#student_credit').html(mgs.total_credit);
        }
    });

    $.ajax({
        url: '../controllers/HomeController.php',
        method: 'get',
        data: {studentId : studentId},
        success: function (mgs) {
            $('#last').html(mgs);
        }
    });
});

</script>