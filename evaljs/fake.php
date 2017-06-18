<?php

$arr = $_GET;

$arr["id"] = empty($arr["id"]) ? uniqid() : $arr["id"];
$response  = json_encode($arr);

header('Content-Type: application/json');
echo $response;
?>