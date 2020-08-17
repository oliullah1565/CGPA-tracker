<?php

include_once('../simple_html_dom/simple_html_dom.php');
session_start();


function getSemesterCode($semester_str)
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

function print_all_result($id,$enrollment)
{
    $start_sem_code = getSemesterCode($enrollment);
    $end_sem_code = 183;

    $fields = array(
        'STUDENT_ID' => $id,
        'SELESTER_ID' => $start_sem_code,
        'Submit'=>'Show Result'
    );

    $ch = curl_init();
    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL,'http://vus.daffodilvarsity.edu.bd/?app=result');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    
    $cup=0;
    $cdown=0;
    
    for($sem_code=(int) $start_sem_code ; $sem_code <= $end_sem_code;)
    {
        $fields['SELESTER_ID'] = $sem_code;

        curl_setopt($ch,CURLOPT_POST,count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields);

        $response = curl_exec($ch);

        $dom = new simple_html_dom();
        $dom->load($response);
        $res = $dom->find('table table table table tr td');

        
        //sgpa
        $up = 0;
        $down =0; 
        $i = 82;
        
        if(($res[86]->plaintext)=='Teaching evaluation pending')
        {
            echo '<br><h3>Your Teaching evaluation is pending for semester code: '.$sem_code.' </h3> <br>';//161-35-1463
        }
        else if($res[$i+1]->plaintext!='Total Credit Requirement :')
        {
            echo '<br><br> 
            <label> Semester code:'.$sem_code.'</label><br>
            <table class="table">
            <thead>
            <tr>
            <th>Subject Code </th>
            <th>Subject Name </th>
            <th>Subject Credit </th>
            <th>Subject Grade </th>
            <th>Subject GPA </th>
            </tr></thead><tbody> ';

            $sub_code = $res[$i+1]->plaintext;
            if($sub_code[-1]=='1'   )
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
            // 
            // $up = $up + ($res[$i+3]->plaintext*$res[$i+5]->plaintext);
            // $down = $down + $res[$i+3]->plaintext;

            //2nd subject
            $i =$i+5;
            if($res[$i+1]->plaintext!='Total Credit Requirement :')
            {
                $sub_code = $res[$i+1]->plaintext;
                if($sub_code[-1]=='1'  )
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
            
                // $up = $up + ($res[$i+3]->plaintext*$res[$i+5]->plaintext);
                // $down = $down + $res[$i+3]->plaintext;

                $i =$i+5;
                if($res[$i+1]->plaintext!='Total Credit Requirement :')
                {
                    $sub_code = $res[$i+1]->plaintext;
                    if($sub_code[-1]=='1'  )
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
                    // $up = $up + ($res[$i+3]->plaintext*$res[$i+5]->plaintext);
                    // $down = $down + $res[$i+3]->plaintext;

                    $i =$i+5;
                    if($res[$i+1]->plaintext!='Total Credit Requirement :')
                    {
                        $sub_code = $res[$i+1]->plaintext;
                        if($sub_code[-1]=='1'  )
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
                        // $up = $up + ($res[$i+3]->plaintext*$res[$i+5]->plaintext);
                        // $down = $down + $res[$i+3]->plaintext;

                        $i =$i+5;
                        if($res[$i+1]->plaintext!='Total Credit Requirement :')
                        {
                            $sub_code = $res[$i+1]->plaintext;
                            if($sub_code[-1]=='1'  )
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
                            // $up = $up + ($res[$i+3]->plaintext*$res[$i+5]->plaintext);
                            // $down = $down + $res[$i+3]->plaintext;
                        }
                    }
                }
            }
            echo '</tbody></table>';
            // $cup = $cup+ $up;
            // $cdown = $cdown+ $down;

            // echo ' <label for="">SGPA = '. number_format(($up/$down), 2, '.', '').' and CGPA : '. number_format(($cup/$cdown), 2, '.', '').'<br> Total Credit taken : '.$cdown.' out of 139 </label>';

        }
        

        if($sem_code%10 ==1)
            $sem_code++;
        else if($sem_code%10 ==2)
            $sem_code++;
        else if($sem_code%10 ==3)
            $sem_code=$sem_code+10-2;
    }

    
}

// print_all_result('161-35-1424','Spring 2016');
if(isset($_GET['studentId']))
    print_all_result($_SESSION['studentId'],$_SESSION['enrolled']);