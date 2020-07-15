<?php

function insertTeacher($db_connection)
{
        $full_name = filter_input(INPUT_POST,'full_name');
        $mobile_number  = filter_input(INPUT_POST,'mobile_number');
        $email_address = filter_input(INPUT_POST,'email_address');
        $status = filter_input(INPUT_POST,'status');
        $username = filter_input(INPUT_POST,'username');
        $password = filter_input(INPUT_POST,'password');
      
        $insertSql="INSERT INTO `teachers`(
            `full_name`,
            `mobile_number`,
            `email_address`,
            `status`,
            `username`,
            `password`,

            )
            VALUES
                (
                    '$full_name',
                    '$mobile_number',
                    '$email_address',
                    '$status',
                    '$username',
                    '$password',
                   
    
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