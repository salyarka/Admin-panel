# Сервис часто задаваемых вопросов (FAQ)
Это система имеет клиентскую часть, для ввода вопросов и часть для администрирования системы.

Возможности:
 - редактирование, удаление, создание тем и вопросов
 - скрытие и публикация вопросов
 - просмотр состояния вопросо (сколько опубликовано, скрыто, заблокировано)
 - логировние действий администраторов
 - блокировка вопросов по заданным словам
 
Требования:
 - PHP >= 5.6.4
 - Laravel 5.3
 - MySQL
  
Установка:
     После копирования репозитория, необходимо запустить команду "composer install", сгенерировать ключ
 при помощи команды "php artisan key:generate", заполнить реквизиты для подключения к СУБД в файле .env,
 запустить команду "php artisan migrate --seed".
 
