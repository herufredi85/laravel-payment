## Instalasi
#### Via Git
```bash
git clone https://github.com/herufredi85/laravel-payment.git

in branch main
```

### Setup Application
run command
```bash
composer update
```
atau:
```bash
composer install
```
Copy file .env dari .env.example
```bash
cp .env.example .env
```
Configuration file .env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelpayment
DB_USERNAME=root
DB_PASSWORD=
```
Optional
```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:QGRW4K7UVzS2M5HE2ZCLlUuiCtOIzRSfb38iWApkphE=
APP_DEBUG=true
```
Generate key
```bash
php artisan key:generate
```
Migrate database
```bash
php artisan migrate
```


run Application
```bash
php artisan serve
```

## Link Postman Documentation
https://documenter.getpostman.com/view/10356003/2s9Xy6rVyW