<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET");

// 
// varifying the input 
//
$data = $_GET;
if (empty($data)
    || !isset($data['scheduleInMonths']) 
    || !isset($data['subscriptionStartDate'])) {

    header("HTTP/1.1 400 Bad Request");
    exit();
}

$scheduleInMonths = (int)$data['scheduleInMonths'];
$subscriptionStartDate = strtotime($data['subscriptionStartDate']);

/*
 * not processing when scheduleInMonths < 0
 * not processing when scheduleInMonths > 36
 * not processing when unacceptable scheduleInMonths date format is provided
 * not processing when provided scheduleInMonths is in future
*/
if ($scheduleInMonths < 0 
    || $scheduleInMonths > 36 
    || strlen($subscriptionStartDate) != 10
    || false === $subscriptionStartDate
    || date('Y-m-d') < date('Y-m-d', $subscriptionStartDate)) {

    header("HTTP/1.1 400 Bad Request");
    exit();
}

/* 
 * get a list of dates for future schedule
 * based on the subscriptionStartDate and schedulesInMonths
 */
$result = [];
$firstDayOfSubscriptionMonth = strtotime(date('Y-m-01', $subscriptionStartDate));
$subscriptionDay = date('d', $subscriptionStartDate);

for ($i = 0; $i < $scheduleInMonths; $i++) {
    // Find out which year is the next month
    $year = date('Y', strtotime('first day of +1 month', $firstDayOfSubscriptionMonth));
    
    // Find out what is the next month
    $month = date('m', strtotime('first day of +1 month', $firstDayOfSubscriptionMonth));
    
    $lastDayOfMonth = date('t', strtotime("$year-$month-01"));
    $day = $subscriptionDay;

    /*
     * When subscriptioDay is greater than the last day of the month
     * for example when subscriptionDay is 31 and the current month 
     * in consideration is February, we pick the last day of February
     */
    if ($subscriptionDay > $lastDayOfMonth) {
        $day = $lastDayOfMonth;
    }

    $dateStr = "$year-$month-$day";
    $firstDayOfSubscriptionMonth = strtotime("$year-$month-01");
    $result[] = $dateStr;
}

header('HTTP/1.1 200 OK');
echo json_encode($result);
