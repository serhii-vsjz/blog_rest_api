## Запуска приложения с помощью docker-compose

sudo docker-compose up

## Endpoints

** api/register ** method ** POST **
роут регистрации пользователя

** api/login ** ** method POST **
роут аутентификации пользователя

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

## Комментарии 

Проверка работостособности выполняется с помощью postman
https://www.postman.com/