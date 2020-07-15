<?php 

function deleteNote($db_connection)
{
    $note_id  = filter_input(INPUT_POST,'note_id');

    $deleteSql = "DELETE
    FROM
    `notes`
    WHERE `note_id` = '$note_id';
    ";

    

    if (!$db_connection->query($deleteSql)) {

        $arr = array('status' => "1", 'error' => $db_connection->error);
    
    } else {
    
        $arr = array('status' => "0");
    }
    
    echo json_encode($arr);
}
?>