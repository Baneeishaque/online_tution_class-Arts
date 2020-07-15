<?php

function updateStream($db_connection)
{
    $stream_id = filter_input(INPUT_POST,'stream_id');
    $stream_name = filter_input(INPUT_POST,'stream_name');
    $course_id  = filter_input(INPUT_POST,'course_id');

    $updateSql = "UPDATE
    `streams`
  SET
    `stream_name` = '$stream_name',
    `course_id` = '$course_id'
  
  WHERE `stream_id` = '$stream_id';
  ";


if (!$db_connection->query($updateSql)) {

  $arr = array('status' => "1", 'error' => $db_connection->error);

} else {

  $arr = array('status' => "0");
}

echo json_encode($arr);
}
?>