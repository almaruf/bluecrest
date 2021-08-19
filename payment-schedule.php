<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET");

$data = $_GET;
if (empty($data)
    || !isset($data['scheduleInMonths']) 
    || !isset($data['subscriptionStartDate'])) {

    header("HTTP/1.1 400 Bad Request");
    exit();
}


$scheduleInMonths = (int)$data['scheduleInMonths'];
$subscriptionStartDate = strtotime($data['subscriptionStartDate']);

if ($scheduleInMonths < 0 
    || $scheduleInMonths > 36 
    || strlen($subscriptionStartDate) != 10
    || false === $subscriptionStartDate
    || date('Y-m-d') < date('Y-m-d', $subscriptionStartDate)) {

    header("HTTP/1.1 400 Bad Request");
    exit();
}

// TODO - process here

$result = [];
header('HTTP/1.1 200 OK');
echo json_encode($result);
