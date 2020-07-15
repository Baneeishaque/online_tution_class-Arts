<?php

function insertStream($db_connection)
{
        $stream_name = filter_input(INPUT_POST,'stream_name');
        $course_id   = filter_input(INPUT_POST,'course_id');

        $insertSql="INSERT INTO `streams`(
            `stream_name`,
            `course_id`
            )
            VALUES
                (
                    '$stream_name',
                    '$course_id'
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