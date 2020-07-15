<?php 

function deleteStudent($db_connection)
{
    $student_id   = filter_input(INPUT_POST,'student_id ');

    $deleteSql = "DELETE
    FROM
    `students`
    WHERE `student_id ` = '$student_id';
    ";

    

    if (!$db_connection->query($deleteSql)) {

        $arr = array('status' => "1", 'error' => $db_connection->error);
    
    } else {
    
        $arr = array('status' => "0");
    }
    
    return json_encode($arr);
}
?>