<?php

function insertSubject($db_connection)
{
        $stream_id  = filter_input(INPUT_POST,'stream_id');
        $subject_name   = filter_input(INPUT_POST,'subject_name');

        $insertSql="INSERT INTO `subjects`(
            `stream_id`,
            `subject_name`
            )
            VALUES
                (
                    '$stream_id',
                    '$subject_name'
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