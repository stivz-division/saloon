## Установка

```
composer install
./vendor/bin/sail up -d
./vendor/bin/sail npm i
./vendor/bin/sail npm run build
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
./vendor/bin/sail artisan storage:link
./vendor/bin/sail artisan parse:yandex-location
```
