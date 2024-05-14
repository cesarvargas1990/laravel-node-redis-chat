# Laravel Redis Chat

This is a real-time chat based on Laravel, Node.js, Socket.io and Redis to link Laravel with Node.Js<br/>
The application sends messages in real-time using socket.io as well as keeps them on db for later.<br/>
<b>Usually chat examples online offer public chat features. This project offers one-to-one chat!</b>

# How to run the app
	install redis
	composer install
	install mysql 
	create database laravel
	php artisan migrate
	execute script or create the next table only if error when execute php artisan migrate command

	-- laravel.migrations definition

CREATE TABLE `migrations` (
  `migration` varchar(100) DEFAULT NULL,
  `batch` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`if`)
) ;
	npm install
	node nodejs/server.js
	php artisan serve
	run the another angular project in port 4200 (setup with node ng view readme.md from these project) the porpuse of these project is send
	message to all users from chat
	open http://localhost:8000/ and register user1 or custom username (any email) in other navigator or anonymus tab open other http://localhost:8000/ register user2 or custom username (any email)
	


Keep in mind that you need redis-server installed on your machine for the application to work.

# Example
[![Watch the video](https://img.youtube.com/vi/QJiZmAAAXPU/0.jpg)](https://www.youtube.com/watch?v=QJiZmAAAXPU)

# Don't forget to star this repo ;)
