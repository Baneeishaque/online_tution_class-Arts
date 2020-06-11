<?php
$stream_fetch_sql = "SELECT `stream_id`, `stream_name`, `course_id` FROM `streams` WHERE `course_id`='" . $_GET['course-id'] . "'";

$stream_fetch_query_result = $db_connection->query($stream_fetch_sql);

$out = '                <select class="form-control" name="studying_stream">
';
while ($stream_fetch_query_result_row = mysqli_fetch_assoc($stream_fetch_query_result)) {

    $out = $out . '<option value="' . $stream_fetch_query_result_row['stream_id'] . '">' . $stream_fetch_query_result_row['stream_name'] . '</option>';
}
$out = $out . '                </select>
';
echo $out;
