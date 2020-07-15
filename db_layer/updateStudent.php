<?php

function updateStudent($db_connection)
{

    $student_id  = filter_input(INPUT_POST,'student_id');
    $full_name = filter_input(INPUT_POST,'full_name');
    $mobile_number  = filter_input(INPUT_POST,'mobile_number');
    $email_address = filter_input(INPUT_POST,'email_address');
    $studying_class = filter_input(INPUT_POST,'studying_class');
    $status = filter_input(INPUT_POST,'status');
    $username = filter_input(INPUT_POST,'username');
    $password = filter_input(INPUT_POST,'password');
    $batch_number = filter_input(INPUT_POST,'batch_number');
    $additional_mobile = filter_input(INPUT_POST,'additional_mobile');
    $additional_email = filter_input(INPUT_POST,'additional_email');
    $photo = filter_input(INPUT_POST,'photo');
    

    $updateSql = "UPDATE
    `students`
  SET
    `full_name` = '$full_name',
    `mobile_number` = '$mobile_number',
    `email_address` = '$email_address',
    `studying_class` = '$studying_class',
    `status` = '$status',
    `username` = '$username',
    `password` = '$password',
    `batch_number` = '$batch_number',
    `additional_mobile` = '$additional_mobile',
    `additional_email` = '$additional_email',
    `photo` = '$photo'
  WHERE `student_id` = '$student_id';
  ";


if (!$db_connection->query($updateSql)) {

  $arr = array('status' => "1", 'error' => $db_connection->error);

} else {

  $arr = array('status' => "0");
}

return json_encode($arr);
}
?>