## Запуска приложения с помощью docker-compose

Клонируем проект 
git clone https://github.com/Serhii-Vasyliev-k/blog_rest_api

Переходим в папку с проектом
cd blog_rest_api

запустить приложение локально
sudo docker-compose up

после запуска открываем новое окно терминала, подключаемся к машине
sudo docker-compose exec app bash

разворачиваем проект laravel
composer install

копируем файл конфигурации laravel
cp .env.example .env

запускаем миграцию и заполняем данными
php artisan migrate --seed

генерируем ключ приложения
php artisan key:generate

устанавливаем ключи passport laravel
php artisan passport:install


Приложени будет доступно на localhost

## Комментарии 

Проверка работостособности выполняется с помощью postman
https://www.postman.com/

GET localhost/api/article


## Endpoints

** api/register ** method ** POST **
роут регистрации пользователя

** api/login ** ** method POST **
роут аутентификации пользователя
возвращает Bearer token зарегестрированому пользователю, для подтверждения аутентификации


** api/article ** method ** GET **
роут со списком всех статей

** api/article/{'id_статьи'} ** method ** GET **
роут открытой статьи

** api/article/ ** method ** POST **; параметры title - название статьи, text - текст статьи
роут создания статьи

** api/article/ ** method ** PUT ** (При запросе указывать метод POST, и добавить параметр _method со значением PUT в тело запроса
роут редактирования статьи

** api/comment/{'id_статьи'} method ** POST **; параметры text - текст коментария
роут добавления комментария к статье

** api/article/{'id_статьи'} ** method ** DELETE ** (удаляет вместе со связаными коментариями
роут удаления статьи

