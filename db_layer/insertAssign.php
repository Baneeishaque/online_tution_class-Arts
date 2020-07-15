<?php

function insertAssign($db_connection)
{
        $teacher_id = filter_input(INPUT_POST,'teacher_id');
        $subject_id = filter_input(INPUT_POST,'subject_id');

        $insertSql="INSERT INTO `assigns`(
            `teacher_id`,
            `subject_id`
            )
            VALUES
                (
                    '$teacher_id',
                    '$subject_id'
                );
            ";

    if (!$db_connection->query($insertSql)) {
    
        $arr = array('status' => "1", 'error' => $db_connection->error);

    } else {

        $arr = array('status' => "0");
    }

    return json_encode($arr);

}
?>