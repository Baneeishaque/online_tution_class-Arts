<?php

function insertAdmin($db_connection)
{
    $admin_username = filter_input(INPUT_POST,'admin_username');
    $admin_password = filter_input(INPUT_POST,'admin_password');

$insertSql="INSERT INTO `admin`(
    `username`,
    `password`
    )
    VALUES
        (
            '$admin_username',
            '$admin_password'
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