<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/functions.php';


header('Content-Type: application/json');

// JSONファイルが存在するかチェック
if (!file_exists(INSTAGRAM_POSTS_JSON)) {
    http_response_code(404);
    $error = "[" . INSTAGRAM_POSTS_JSON . "] not found";

    logMessage($error);
    echo json_encode(["error" => $error]);
    exit;
}

// JSONを読み込んで返す
$jsonData = file_get_contents(INSTAGRAM_POSTS_JSON);
echo $jsonData;
