<?php
include_once 'db_config.php';

$stream_id = "";
if (isset($_GET['stream-id'])) {
    $stream_id = $_GET['stream-id'];
}

$batch_fetch_sql = "SELECT `batch_id`, `batch_name` FROM `batchs` WHERE `stream_id`='$stream_id'";
$batchFetchQueryResult = $db_connection->query($batch_fetch_sql);

$out = array();
while ($batchFetchQueryResultRow = mysqli_fetch_assoc($batchFetchQueryResult)) {

    $out[] = $batchFetchQueryResultRow;
}

echo json_encode($out);
