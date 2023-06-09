<p align="center">
<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Проект Доставка тест

Этот проект представляет собой шаблон Laravel-приложения, интегрированного с Docker, 
для удобного развертывания и запуска проекта на разных окружениях.
Не хотел использовать репозиторы и сервисы так как нету смысла их использовать.


Требования


- [Docker](https://docker.com).
- [Docker Compose](https://docs.docker.com/compose/).

## Установка и запуск

1. Клонирование репозитория
2. Перейдите в каталог проекта
3. Скопируйте файл .env.example и переименуйте его в .env
4. Запустите контейнеры Docker с помощью Docker Compose
   **docker-compose up -d** - Это создаст и запустит контейнеры с Laravel приложением, базой данных MySQL и phpMyAdmin.
5. Выполните миграции и заполнение базы данных
    **docker-compose exec app php artisan migrate --seed** - Это выполнит миграции и заполнит базу данных тестовыми данными.
6. Приложение Laravel доступно по адресу http://localhost:8876/
7. phpMyAdmin доступен по адресу http://localhost:8101.
8. Импортируйте в Postman courier-test.postman_collection.json.

## Установка и запуск
Чтобы остановить и удалить контейнеры Docker, выполните следующую команду в корневом каталоге проекта:
- **docker-compose down**
