<?php

$isInClientServer = false;

$cpanel_username = "ssquareq";
if ($isInClientServer) {
    $cpanel_username = "tirurart";
}
$cpanel_username_suffix = "_";

$db_server = "localhost";
$db_server_user = $cpanel_username . $cpanel_username_suffix . "root";
if ($isInClientServer) {
    $db_server_user = $cpanel_username . $cpanel_username_suffix . "dba";
}
$db_server_password = "aA9895204814";
if ($isInClientServer) {
    $db_server_password = "aA159357!";
}
$db_name = $cpanel_username . $cpanel_username_suffix . "tution_class";
if ($isInClientServer) {
    $db_name = $cpanel_username . $cpanel_username_suffix . "db";
}
$db_connection = new mysqli($db_server, $db_server_user, $db_server_password, $db_name);
if ($db_connection->connect_error) {

    die("connection failure" . $db_connection->connect_error);
}
