<?php 

function deleteTeacher($db_connection)
{
    $teacher_id    = filter_input(INPUT_POST,'teacher_id  ');

    $deleteSql = "DELETE
    FROM
    `teachers`
    WHERE `teacher_id  ` = '$teacher_id';
    ";

    

    if (!$db_connection->query($deleteSql)) {

        $arr = array('status' => "1", 'error' => $db_connection->error);
    
    } else {
    
        $arr = array('status' => "0");
    }
    
    return json_encode($arr);
}
?>