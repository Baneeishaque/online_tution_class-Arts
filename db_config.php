<?php

$cpanel_username = "ssquareq";
$cpanel_username_suffix = "_";

$db_server = "localhost";
$db_server_user = $cpanel_username . $cpanel_username_suffix . "dotlocus";
$db_server_password = "aA9895204814";
$db_name = $cpanel_username . $cpanel_username_suffix . "tution_class";

$db_connection = new mysqli($db_server, $db_server_user, $db_server_password, $db_name);
if ($db_connection->connect_error) {

    die("connection failure" . $db_connection->connect_error);
}
