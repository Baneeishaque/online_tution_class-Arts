<?php 

function deleteAdmin($db_connection)
{
    $admin_id = filter_input(INPUT_POST,'admin_id');

    $deleteSql = "DELETE
    FROM
    `admin`
    WHERE `admin_id` = '$admin_id';
    ";

    

    if (!$db_connection->query($deleteSql)) {

        $arr = array('status' => "1", 'error' => $db_connection->error);
    
    } else {
    
        $arr = array('status' => "0");
    }
    
    echo json_encode($arr);
}
?>