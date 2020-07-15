<?php

function insertStudent($db_connection)
{
        $full_name = filter_input(INPUT_POST,'full_name');
        $mobile_number  = filter_input(INPUT_POST,'mobile_number');
        $email_address = filter_input(INPUT_POST,'email_address');
        $studying_class = filter_input(INPUT_POST,'studying_class');
        $status = filter_input(INPUT_POST,'status');
        $username = filter_input(INPUT_POST,'username');
        $password = filter_input(INPUT_POST,'password');
        $batch_number = filter_input(INPUT_POST,'batch_number');
        $additional_mobile = filter_input(INPUT_POST,'additional_mobile');
        $additional_email = filter_input(INPUT_POST,'additional_email');
        $photo = filter_input(INPUT_POST,'photo');
       

        $insertSql="INSERT INTO `students`(
            `full_name`,
            `mobile_number`,
            `email_address`,
            `studying_class`,
            `status`,
            `username`,
            `password`,
            `batch_number`,
            `additional_mobile`,
            `additional_email`,
            `photo`,
            )
            VALUES
                (
                    '$full_name',
                    '$mobile_number',
                    '$email_address',
                    '$studying_class',
                    '$status',
                    '$username',
                    '$password',
                    '$batch_number',
                    '$additional_mobile',
                    '$additional_email',
                    '$photo',
                   
    
                );
            ";

    if (!$db_connection->query($insertSql)) {
    
        $arr = array('status' => "1", 'error' => $db_connection->error);

    } else {

        $arr = array('status' => "0");
    }

    echo json_encode($arr);

}
?>