## Установка

### Установка Composer зависимостей

```shell
composer install
```

### Установка Sail и npm пакетов

```shell
./vendor/bin/sail up
sail up -d
sail npm i
sail npm run dev
```

### Настройка конфига

```dotenv
APP_URL=http://localhost:4070
APP_PORT=4070
VITE_PORT=5175

AMOCRM_CLIENT_ID=
AMOCRM_CLIENT_SECRET=
AMOCRM_AUTH_CODE=
AMOCRM_REDIRECT_URI=
AMOCRM_SUBDOMAIN=
```
