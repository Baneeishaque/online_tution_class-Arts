<?php 

function deleteCourse($db_connection)
{
    $course_id = filter_input(INPUT_POST,'course_id');

    $deleteSql = "DELETE
    FROM
    `courses`
    WHERE `course_id` = '$course_id';
    ";

    

    if (!$db_connection->query($deleteSql)) {

        $arr = array('status' => "1", 'error' => $db_connection->error);
    
    } else {
    
        $arr = array('status' => "0");
    }
    
    echo json_encode($arr);
}
?>