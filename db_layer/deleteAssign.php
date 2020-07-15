<?php 

function deleteAssign($db_connection)
{
    $assign_id  = filter_input(INPUT_POST,'assign_id');

    $deleteSql = "DELETE
    FROM
    `assigns`
    WHERE `assign_id` = '$assign_id';
    ";

    

    if (!$db_connection->query($deleteSql)) {

        $arr = array('status' => "1", 'error' => $db_connection->error);
    
    } else {
    
        $arr = array('status' => "0");
    }
    
    return json_encode($arr);
}
?>