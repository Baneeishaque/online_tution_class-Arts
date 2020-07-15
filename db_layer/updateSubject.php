<?php

function updateSubject($db_connection)
{
    $subject_id  = filter_input(INPUT_POST,'subject_id');
    $stream_id  = filter_input(INPUT_POST,'stream_id');
    $subject_name  = filter_input(INPUT_POST,'subject_name');

    $updateSql = "UPDATE
    `subjects`
  SET
    `stream_id` = '$stream_id',
    `subject_name` = '$subject_name'
  
  WHERE `subject_id` = '$subject_id';
  ";


if (!$db_connection->query($updateSql)) {

  $arr = array('status' => "1", 'error' => $db_connection->error);

} else {

  $arr = array('status' => "0");
}

echo json_encode($arr);
}
?>