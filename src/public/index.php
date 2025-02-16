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
    <link rel="stylesheet" href="/css/style.css">
    </style>
</head>
<body>

    <h1>Instagram Posts</h1>

    <div class="container">
        <section class="php">
            <h2>PHP</h2>
            <div class="instagram-posts">
                <?php if (empty($posts)): ?>
                    <p>投稿がありません。</p>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="instagram-posts__post post">
                            <a class="post__link" href="<?= htmlspecialchars($post['permalink']) ?>" target="_blank">
                                <img class="post__image" src="<?= htmlspecialchars($post['media_type'] === 'VIDEO' ? $post['thumbnail_url'] : $post['media_url']) ?>" alt="Instagram Post">
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <section class="javascript">
            <h2>JavaScript</h2>
            <div id="posts-container" class="instagram-posts">
            </div>
        </section>
    </div>

    <script src="/js/script.js"></script>
</body>
</html>
