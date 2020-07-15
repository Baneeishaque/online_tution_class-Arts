<?php 

function deleteBatch($db_connection)
{
    $batch_id  = filter_input(INPUT_POST,'batch_id');

    $deleteSql = "DELETE
    FROM
    `batchs`
    WHERE `batch_id` = '$batch_id';
    ";

    

    if (!$db_connection->query($deleteSql)) {

        $arr = array('status' => "1", 'error' => $db_connection->error);
    
    } else {
    
        $arr = array('status' => "0");
    }
    
    return json_encode($arr);
}
?>