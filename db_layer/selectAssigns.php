<?php

function selectAssigns($db_connection)
{
    $selectSql = "SELECT
                    `assign_id`,
                    `teacher_id`,
                    `subject_id `
                FROM
                    `assigns`;
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