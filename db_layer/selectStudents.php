<?php

function selectStudents($db_connection)
{
    $selectSql = "SELECT
                    `student_id`,
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
                    `photo` 
                   
                FROM
                    `students`;
                ";

    $selectSqlResult = $db_connection->query($selectSql);

    $out = array();

    if (mysqli_num_rows($selectSqlResult) != 0) {

        array_push($out, array("status" => "0"));

        while ($selectSqlResultRow = mysqli_fetch_assoc($selectSqlResult)) {

            $out[] = $selectSqlResultRow;
        }
    } else {

        array_push($out, array("status" => "1"));
    }

    return json_encode($out);
}
?>