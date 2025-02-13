FROM php:8.2-fpm

# PHP の設定ファイルをコピー
COPY php.ini /usr/local/etc/php/php.ini

# タイムゾーン設定
ARG TZ
ENV TZ=${TZ}
# Instagram API の設定
ARG INSTAGRAM_ACCESS_TOKEN
ENV INSTAGRAM_ACCESS_TOKEN=${INSTAGRAM_ACCESS_TOKEN}
ARG INSTAGRAM_BUSINESS_ID
ENV INSTAGRAM_BUSINESS_ID=${INSTAGRAM_BUSINESS_ID}

RUN echo "INSTAGRAM_ACCESS_TOKEN=$INSTAGRAM_ACCESS_TOKEN" >> /etc/environment
RUN echo "INSTAGRAM_BUSINESS_ID=$INSTAGRAM_BUSINESS_ID" >> /etc/environment

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y cron && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# `cronjob` をシステムに登録
COPY cronjob /etc/cron.d/cronjob
# cronjob の先頭に TZ を追加
RUN sed -i "1iTZ=${TZ}" /etc/cron.d/cronjob
RUN chmod 0644 /etc/cron.d/cronjob && crontab /etc/cron.d/cronjob

# `cron` を起動するスクリプトを作成
COPY start-cron.sh /usr/local/bin/start-cron.sh
RUN chmod +x /usr/local/bin/start-cron.sh

# PHP-FPM設定
RUN sed -i 's/^;clear_env = no/clear_env = no/' /usr/local/etc/php-fpm.d/www.conf
# `cron` を起動しつつ PHP-FPM も起動
CMD ["/usr/local/bin/start-cron.sh"]
