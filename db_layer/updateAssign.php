<?php

function updateAssign($db_connection)
{
    $assign_id  = filter_input(INPUT_POST,'assign_id');
    $teacher_id = filter_input(INPUT_POST,'teacher_id');
    $subject_id = filter_input(INPUT_POST,'subject_id');

    $updateSql = "UPDATE
    `assigns`
  SET
    `teacher_id` = '$teacher_id',
    `subject_id` = '$subject_id'
  
  WHERE `assign_id` = '$assign_id';
  ";


if (!$db_connection->query($updateSql)) {

  $arr = array('status' => "1", 'error' => $db_connection->error);

} else {

  $arr = array('status' => "0");
}

echo json_encode($arr);
}
?>