<div class="container-fluid">
    <div class="row">
        <div class="col-12">

        <div id="all_result"></div>

        </div>
    </div>
</div>

<script>
$(document).ready(function (){

    document.getElementById('page_name').innerHTML = 'Result spring';
    
    var studentId= <?php session_start();
    if(isset($_SESSION['studentId']))
    echo "'".$_SESSION['studentId']."'";
    else {
        echo 'not found';
    }
    ?>;
    if(studentId!='not found')
    {
        $.ajax({
            url: '../controllers/result/print_all_result_spring.php',
            method: 'get',
            data: {studentId : studentId},
            success: function (mgs) {
                $('#all_result').html(mgs);
            }
        });
    }
    else
    {
        
    }
    

});

</script>