<?php 

function deleteAdmin($db_connection)
{
    $admin_username = filter_input(INPUT_POST,'admin_username');

    $deleteSql = "DELETE
    FROM
    `admin`
    WHERE `username` = '$admin_username';
    ";

    

    if (!$db_connection->query($deleteSql)) {

        $arr = array('status' => "1", 'error' => $db_connection->error);
    
    } else {
    
        $arr = array('status' => "0");
    }
    
    return json_encode($arr);
}
?>