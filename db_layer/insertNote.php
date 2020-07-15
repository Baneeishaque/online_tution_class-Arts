<?php

function insertNote($db_connection)
{
        $teacher_id = filter_input(INPUT_POST,'teacher_id');
        $subject_id = filter_input(INPUT_POST,'subject_id ');
        $title = filter_input(INPUT_POST,'title');
        $description = filter_input(INPUT_POST,'description');
        $file = filter_input(INPUT_POST,'file');
        $status = filter_input(INPUT_POST,'status');
       

        $insertSql="INSERT INTO `notes`(
            `teacher_id`,
            `subject_id`,
            `title`,
            `description`,
            `file`,
            `status`
            )
            VALUES
                (
                    '$teacher_id',
                    '$subject_id',
                    '$title',
                    '$description',
                    '$file',
                    '$status'
    
                );
            ";

    if (!$db_connection->query($insertSql)) {
    
        $arr = array('status' => "1", 'error' => $db_connection->error);

    } else {

        $arr = array('status' => "0");
    }

    return json_encode($arr);

}
?>