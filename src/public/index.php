<?php
require_once __DIR__ . '/../config/config.php'; // 設定ファイルを読み込む

// JSONファイルからデータを読み込む
$posts = [];
if (file_exists(INSTAGRAM_POSTS_JSON)) {
    $jsonData = file_get_contents(INSTAGRAM_POSTS_JSON);
    $data = json_decode($jsonData, true);
    $posts = $data ?: [];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Posts</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .container { max-width: 800px; margin: auto; }
        .post { display: inline-block; margin: 10px; }
        .post img { width: 200px; height: auto; border-radius: 10px; }
    </style>
</head>
<body>

    <h1>Instagram Posts</h1>
    <section class="php">
        <h2>PHP</h2>
        <div class="container">
            <?php if (empty($posts)): ?>
                <p>投稿がありません。</p>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <div class="post">
                        <a href="<?= htmlspecialchars($post['permalink']) ?>" target="_blank">
                            <img src="<?= htmlspecialchars($post['media_type'] === 'VIDEO' ? $post['thumbnail_url'] : $post['media_url']) ?>" alt="Instagram Post">
                        </a>
                        <p><?= htmlspecialchars($post['caption'] ?? 'No Caption') ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <section class="javascript">
        <h2>JavaScript</h2>
        <div id="posts-container" class="container">
        </div>
    </section>

    <script src="/js/script.js"></script>
</body>
</html>
