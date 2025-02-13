<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/functions.php';

$accessToken = getenv('INSTAGRAM_ACCESS_TOKEN');
$businessId = getenv('INSTAGRAM_BUSINESS_ID');

logMessage("Start fetch Instagram API.");
logMessage("INSTAGRAM_POSTS_JSON: " . INSTAGRAM_POSTS_JSON);

try {
    if (!$accessToken || !$businessId) {
        throw new Exception("Missing required environment variables.");
    }

    // APIエンドポイント (投稿データ取得)
    $endpoint = "https://graph.facebook.com/v22.0/{$businessId}/media";
    $params = [
        'fields' => 'id,caption,permalink,media_type,media_url,thumbnail_url,timestamp',
        'access_token' => $accessToken,
    ];

    // APIリクエストURLの作成
    $mediaUrl = $endpoint . '?' . http_build_query($params);
    logMessage("fields: {$params['fields']}");

    // APIリクエスト
    $response = @file_get_contents($mediaUrl);

    if ($response === false) {
        throw new Exception("Failed to fetch data from Instagram API.");
    }

    // JSONデコード
    $data = json_decode($response, true);

    if (!isset($data['data'])) {
        throw new Exception("Invalid API response: " . json_encode($data));
    }

    // JSONファイルに保存
    if (file_put_contents(INSTAGRAM_POSTS_JSON, json_encode($data['data'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) === false) {
        throw new Exception("Failed to save data to " . INSTAGRAM_POSTS_JSON);
    }

    logMessage("Instagram posts saved to " . INSTAGRAM_POSTS_JSON);

} catch (Exception $e) {
    logMessage("Error: " . $e->getMessage());
    echo "❌ Error: " . $e->getMessage() . "\n";
}
