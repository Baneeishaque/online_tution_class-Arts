<?php

function updateBatch($db_connection)
{
    $batch_id  = filter_input(INPUT_POST,'batch_id');
    $batch_name = filter_input(INPUT_POST,'batch_name');
    $stream_id = filter_input(INPUT_POST,'stream_id');

    $updateSql = "UPDATE
    `batchs`
  SET
    `batch_name` = '$batch_name',
    `stream_id` = '$stream_id'
  
  WHERE `batch_id` = '$batch_id';
  ";


if (!$db_connection->query($updateSql)) {

  $arr = array('status' => "1", 'error' => $db_connection->error);

} else {

  $arr = array('status' => "0");
}

return json_encode($arr);
}
?>