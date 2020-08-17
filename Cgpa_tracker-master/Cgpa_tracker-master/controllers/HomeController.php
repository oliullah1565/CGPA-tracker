<?php

include_once('simple_html_dom/simple_html_dom.php');

session_start();

function semStrToSemCode($semester_str)
{
    $semester_str = strtolower($semester_str);

    list($semester,$year) = explode(" ", $semester_str);
    $sem_code = $year[-2].$year[-1];
    
    if($semester=="spring")
    {
        $sem_code=$sem_code.'1';
        return $sem_code;
    }
    else if($semester=="summer")
    {
        $sem_code=$sem_code.'2';
        return $sem_code;
    }
    else if($semester=="fall")
    {
        $sem_code=$sem_code.'3';
        return $sem_code;
    }
     
    return 'Did no match semester';
    
}




function getStudentDetails($id)
{
    $fields = array(
        'STUDENT_ID' => $id,
        'SELESTER_ID' => '101',
        'Submit'=>'Show Result'
    );


    $ch = curl_init();
    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL,'http://vus.daffodilvarsity.edu.bd/?app=result');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_POST,count($fields));
    curl_setopt($ch,CURLOPT_POSTFIELDS,$fields);

    $response = curl_exec($ch);
    curl_close($ch);
    
    $dom = new simple_html_dom();
    $dom->load($response);
    $res = $dom->find('table table table table tr td');


    $student= [
        'id'=> $id,
        'program' => $res[56]->plaintext,
        'batch' => $res[59]->plaintext,
        'name' => $res[62]->plaintext,
        'enrollment' =>$res[74]->plaintext,
        'total_credit' => $res[84]->plaintext
    ];
    
    $_SESSION['studentId'] = $student['id'];
    $_SESSION['enrolled'] = $student['enrollment'];

    echo json_encode($student);
}


function lastSemResult($id)
{
    $fields = array(
        'STUDENT_ID' => $id,
        'SELESTER_ID' => '183',
        'Submit'=>'Show Result'
    );


    $ch = curl_init();
    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL,'http://vus.daffodilvarsity.edu.bd/?app=result');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_POST,count($fields));
    curl_setopt($ch,CURLOPT_POSTFIELDS,$fields);

    $response = curl_exec($ch);
    curl_close($ch);

    $dom = new simple_html_dom();
    $dom->load($response);
    $res = $dom->find('table table table table tr td');
    
    $i = 82;

    if(($res[86]->plaintext)=='Teaching evaluation pending')
    {
        echo '<br><h3>Your Teaching evaluation is pending for semester : Fall 2018 </h3> <br>';
    }
    else if($res[$i+1]->plaintext!='Total Credit Requirement :')
    {
        echo '
        <table class="table">
        <tr>
        <th>Subject Code</th>
        <th>Subject Name</th>
        <th>Subject Credit</th>
        <th>Subject Grade</th>
        <th>Subject GPA</th>
        </tr>';
        echo '
        <tr>
            <td>'.$res[$i+1]->plaintext.'</td>
            <td>'.$res[$i+2]->plaintext.'</td>
            <td>'.$res[$i+3]->plaintext.'</td>
            <td>'.$res[$i+4]->plaintext.'</td>
            <td>'.$res[$i+5]->plaintext.'</td>
        </tr>';
    
        $i =$i+5;
        if($res[$i+1]->plaintext!='Total Credit Requirement :')
        {
            echo '
            <tr>
                <td>'.$res[$i+1]->plaintext.'</td>
                <td>'.$res[$i+2]->plaintext.'</td>
                <td>'.$res[$i+3]->plaintext.'</td>
                <td>'.$res[$i+4]->plaintext.'</td>
                <td>'.$res[$i+5]->plaintext.'</td>
            </tr>';
        
            $i =$i+5;
            if($res[$i+1]->plaintext!='Total Credit Requirement :')
            {
                echo '
                <tr>
                    <td>'.$res[$i+1]->plaintext.'</td>
                    <td>'.$res[$i+2]->plaintext.'</td>
                    <td>'.$res[$i+3]->plaintext.'</td>
                    <td>'.$res[$i+4]->plaintext.'</td>
                    <td>'.$res[$i+5]->plaintext.'</td>
                </tr>';
            
                $i =$i+5;
                if($res[$i+1]->plaintext!='Total Credit Requirement :')
                {
                    echo '
                    <tr>
                        <td>'.$res[$i+1]->plaintext.'</td>
                        <td>'.$res[$i+2]->plaintext.'</td>
                        <td>'.$res[$i+3]->plaintext.'</td>
                        <td>'.$res[$i+4]->plaintext.'</td>
                        <td>'.$res[$i+5]->plaintext.'</td>
                    </tr>';
                
                    $i =$i+5;
                    if($res[$i+1]->plaintext!='Total Credit Requirement :')
                    {
                        echo '
                        <tr>
                            <td>'.$res[$i+1]->plaintext.'</td>
                            <td>'.$res[$i+2]->plaintext.'</td>
                            <td>'.$res[$i+3]->plaintext.'</td>
                            <td>'.$res[$i+4]->plaintext.'</td>
                            <td>'.$res[$i+5]->plaintext.'</td>
                        </tr>';
                    }
                }
            }
        }
    }


    echo '</table>';

}

if(isset($_POST['studentId']))
{
    getStudentDetails($_POST['studentId']);
}

if(isset($_GET['studentId']))
{
    lastSemResult($_GET['studentId']);
}
