<?php

function logMessage($message) {
    $logFile = "/var/www/html/log/task.log";
    file_put_contents($logFile, date("Y-m-d H:i:s") . " | " . $message . "\n", FILE_APPEND);
}
