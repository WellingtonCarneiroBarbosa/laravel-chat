# Realtime WebChat
![Alt Text](./public/readme-assets/realtime-chat.gif)

*Before everthing: if you thought it wass cool, please, give me a start ❤️**

## Sobre o Projeto

Application developed to undestand better how Laravel works with Vue.Js and Inertia.Js + Laravel WebSockets. It is interesting to say the realtime developed on application does not depends from any API like [puser](https://pusher.com). It is 100% WebSockets.👌

### Used Stacks

- Laravel 8.x
- Vue.js 
- Inertia.js
- Tailwind Css

## Tunning it on localhost
**Requirements: Stack [LAMPP ou XAMPP](https://www.apachefriends.org/index.html) | [Composer](https://getcomposer.org/download/) | [NPM](https://nodejs.org/en/download/)**

### Etapas
1. Clone the repository
```
git clone https://github.com/wellingtoncarneirobarbosa/laravel-chat.git
```

2. Install the PHP dependencies
```
composer install
```

3. Install the JS dependencies
```
npm install
```

4. Build the js files
```
npm run dev
```

5. Create a new .env on root with content from [.env.example](./.env.example)

6. Create a new local database called "laravel-chat" - <i>Its important the database's charset is <b>utf8mb4_general_ci</b> to support emotes</i>

7. Generate a new app key
```
php artisan key:generate
```

8. Publish the database tables
```
php artisan migrate
```

9. Run a new local serv
```
php artisan serve
```

10. In another shell, run the websocket serv
```
php artisan websocket:serve
```

11. [Click Here](http://localhost:8000/laravel-websockets) or in your navigator open "http://localhost:8000/laravel-websockets" and click in "Connect" 

12. [Click Here](http://localhost:8000/register) or in your navigator open "http://localhost:8000/register" and create some new users

13. [Click Heri](http://localhost:8000/dashboard/chat) or in your navigator open "http://localhost:8000/dashboard/chat" and test my realtime chat :)

## Author
<a href="https://github.com/wellingtoncarneirobarbosa" target="_blank">
<img src="./public/readme-assets/autor.jpg" width="80" height="80" alt="Wellington Carneiro Barbosa"> Wellington Barbosa
</a>
<br>
<a href="https://instagram.com/owellcarneiro" target="_blank">
Instagram
</a>
|
<a href="https://linkedin.com/in/wellingtoncarneirobarbosa" target="_blank">
LinkedIn
</a>
|
<a href="https://facebook.com/owellcarneiro" target="_blank">
Facebook
</a>


## Licença

That is a study project and is under [MIT License](https://opensource.org/licenses/MIT).
