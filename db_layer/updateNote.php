<?php

function updateNote($db_connection)
{
        $note_id = filter_input(INPUT_POST,'note_id ');
        $teacher_id = filter_input(INPUT_POST,'teacher_id');
        $subject_id = filter_input(INPUT_POST,'subject_id ');
        $title = filter_input(INPUT_POST,'title');
        $description = filter_input(INPUT_POST,'description');
        $file = filter_input(INPUT_POST,'file');
        $status = filter_input(INPUT_POST,'status');
    

    $updateSql = "UPDATE
    `notes`
  SET
    `teacher_id` = '$teacher_id',
    `subject_id` = '$subject_id',
    `title` = '$title',
    `description` = '$description',
    `file` = '$file',
    `status` = '$status'
  
  WHERE `note_id` = '$note_id';
  ";


if (!$db_connection->query($updateSql)) {

  $arr = array('status' => "1", 'error' => $db_connection->error);

} else {

  $arr = array('status' => "0");
}

return json_encode($arr);
}
?>