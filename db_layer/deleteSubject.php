<?php 

function deleteSubject($db_connection)
{
    $subject_id = filter_input(INPUT_POST,'subject_id');

    $deleteSql = "DELETE
    FROM
    `subjects`
    WHERE `subject_id ` = '$subject_id';
    ";

    

    if (!$db_connection->query($deleteSql)) {

        $arr = array('status' => "1", 'error' => $db_connection->error);
    
    } else {
    
        $arr = array('status' => "0");
    }
    
    return json_encode($arr);
}
?>