## Установка

```
composer install
./vendor/bin/sail up -d
./vendor/bin/sail npm i
./vendor/bin/sail npm run build
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
./vendor/bin/sail artisan storage:link
./vendor/bin/sail artisan parse:dogs
./vendor/bin/sail artisan parse:yandex-location
./vendor/bin/sail artisan scout:sync-index-settings
```

### ENV

```
CACHE_DRIVER=redis
FILESYSTEM_DISK=public
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

YOOKASSA_SHOP_ID=
YOOKASSA_API_KEY=
YOOKASSA_RETURN_URL=

SCOUT_DRIVER=meilisearch
MEILISEARCH_HOST=
MEILISEARCH_NO_ANALYTICS=false
MEILISEARCH_KEY=
```