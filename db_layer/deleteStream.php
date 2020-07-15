<?php 

function deleteStream($db_connection)
{
    $stream_id   = filter_input(INPUT_POST,'stream_id ');

    $deleteSql = "DELETE
    FROM
    `streams`
    WHERE `stream_id` = '$stream_id';
    ";

    

    if (!$db_connection->query($deleteSql)) {

        $arr = array('status' => "1", 'error' => $db_connection->error);
    
    } else {
    
        $arr = array('status' => "0");
    }
    
    return json_encode($arr);
}
?>