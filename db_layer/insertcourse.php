<?php

function insertCourse($db_connection)
{
        $course_name = filter_input(INPUT_POST,'course_name');
       

        $insertSql="INSERT INTO `courses`(
            `course_name`
            )
            VALUES
                (
                    '$course_name'
                    
                );
            ";

    if (!$db_connection->query($insertSql)) {
    
        $arr = array('status' => "1", 'error' => $db_connection->error);

    } else {

        $arr = array('status' => "0");
    }

    echo json_encode($arr);

}
?>