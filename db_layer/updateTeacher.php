<?php

function updateTeacher($db_connection)
{

    $teacher_id   = filter_input(INPUT_POST,'teacher_id');
    $full_name = filter_input(INPUT_POST,'full_name');
    $mobile_number  = filter_input(INPUT_POST,'mobile_number');
    $email_address = filter_input(INPUT_POST,'email_address');
    $status = filter_input(INPUT_POST,'status');
    $username = filter_input(INPUT_POST,'username');
    $password = filter_input(INPUT_POST,'password');

    

    $updateSql = "UPDATE
    `teachers`
  SET
    `full_name` = '$full_name',
    `mobile_number` = '$mobile_number',
    `email_address` = '$email_address',
    `status` = '$status',
    `username` = '$username',
    `password` = '$password',

  WHERE `teacher_id` = '$teacher_id';
  ";


if (!$db_connection->query($updateSql)) {

  $arr = array('status' => "1", 'error' => $db_connection->error);

} else {

  $arr = array('status' => "0");
}
  return json_encode($arr);
}
?>