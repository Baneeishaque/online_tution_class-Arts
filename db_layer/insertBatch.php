<?php

function insertBatch($db_connection)
{
        $batch_name = filter_input(INPUT_POST,'batch_name');
        $stream_id  = filter_input(INPUT_POST,'stream_id ');

        $insertSql="INSERT INTO `batchs`(
            `batch_name`,
            `stream_id`
            )
            VALUES
                (
                    '$batch_name',
                    '$stream_id'
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