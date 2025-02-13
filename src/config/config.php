<?php
// JSONファイルの保存先 (絶対パスに変換)
define('INSTAGRAM_POSTS_JSON', realpath(__DIR__ . '/../cron/instagram_posts.json') ?: __DIR__ . '/../cron/instagram_posts.json');
