<?php 
echo "<h2>User friendly interface for testing</h2>";
$html = "<form name=\"test\">"
. "Start date: <input name=\"subscriptionStartDate\"/>\n"
. "Number of months: <input name=\"scheduleInMonths\"/>"
. "<input type=\"submit\"/>"
. "</form>";
echo $html;

if (!empty($_GET)){ 
    if (!isset($_GET['subscriptionStartDate']) 
        || !isset($_GET['scheduleInMonths'])){

        echo "Invalid data provided";
        return;
    }

    test($_GET);
}

function test($data) {
    $base = "http://tools.almaruf.com/payment-schedule.php";
    $url = $base . "?". http_build_query($data);
    echo "<p>You can also try: curl \"$url\"</p>";

    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $output = curl_exec($ch);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    curl_close($ch);
}?>
