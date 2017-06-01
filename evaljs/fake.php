<?php

$arr = $_GET;

$arr["id"] = uniqid();
$response  = json_encode($arr);

header('Content-Type: application/json');
echo $response;
?>