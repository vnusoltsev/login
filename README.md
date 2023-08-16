## Login as another user

## Краткое орисание

Сервис позволяет зарегестрированному пользователю зайти за другого пользователя 
не заня его пароль, но имея секретный ключ

## Технологический стек

- PHP 8.1 + Laravel 10.10
- VueJS 3.2.41
- MySQL 11


## Запуск сервиса
    composer install --ignore-platform-reqs &&
    npm install &&
    npm run dev
    php artisan serve

## Запуск сервиса в Docker
	docker-compose build
	docker-compose up -d

## Описание логики
- Зарегистрировать несколько пользователей
- Создать секретный ключь для одного из пользователей с помощью команды:
   `php artisan serve php artisan app:add-secret-key {email} {secretKey}`
- Залогиниться под пользователем
- Прейти на страницу Login as user `/login-as-user`
- Ввести email пользователя под которым хочешь залогиниться
- Ввести свой секретный ключ
- Login
