<?php

function updateAdmin($db_connection)
{
    $admin_id = filter_input(INPUT_POST,'admin_id');
    $admin_username = filter_input(INPUT_POST,'admin_username');
    $admin_password = filter_input(INPUT_POST,'admin_password');

    $updateSql = "UPDATE
    `admin`
  SET
    `username` = '$admin_username',
    `password` = '$admin_password'
  
  WHERE `admin_id` = '$admin_id';
  ";


if (!$db_connection->query($updateSql)) {

  $arr = array('status' => "1", 'error' => $db_connection->error);

} else {

  $arr = array('status' => "0");
}

return json_encode($arr);
}
?>