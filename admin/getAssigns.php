<?php
include_once '../db_config.php';

$subject_id = $_GET['subject-id'];

$assign_fetch_sql = "SELECT `assigns`.`teacher_id`,`teachers`.`full_name`,`teachers`.`mobile_number` FROM `assigns`,`teachers` WHERE `assigns`.`teacher_id`=`teachers`.`teacher_id` AND `subject_id`='$subject_id'";
$assignFetchQueryResult = $db_connection->query($assign_fetch_sql);

$out = array();
while ($assignFetchQueryResultRow = mysqli_fetch_assoc($assignFetchQueryResult)) {

    $out[] = $assignFetchQueryResultRow;
}

echo json_encode($out);
