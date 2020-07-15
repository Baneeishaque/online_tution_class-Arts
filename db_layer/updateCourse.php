<?php

function updateCourse($db_connection)
{
    $course_id = filter_input(INPUT_POST,'course_id');
    $course_name = filter_input(INPUT_POST,'course_name');
    

    $updateSql = "UPDATE
    `courses`
  SET
    `course_name` = '$course_name'
    
  
  WHERE `course_id` = '$course_id';
  ";


if (!$db_connection->query($updateSql)) {

  $arr = array('status' => "1", 'error' => $db_connection->error);

} else {

  $arr = array('status' => "0");
}

return json_encode($arr);
}
?>