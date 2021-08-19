<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET");

$data = $_GET;
if (empty($data)) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

// TODO check valid data
// prepare data 
// return correct format etc
