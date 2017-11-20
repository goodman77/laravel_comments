
## About Laravel Comment

This is a simple Laravel comment with reply. Front end HTML 5 validation & Jquery AJAX.

## Instructions

- You could use any local server like MAMP or apache
- clone this repo
- make sure to run "composer install" to install any dependencies

- create a database and setup the credintials in .env
- run "php artisan migrate" to migrate the tables
- run "php artisan db:seed" to seed the table with intial post = 1 
- navigate to localhost/post/1
- Code to look for :
  1. Main controller: https://github.com/goodman77/laravel_comments/blob/master/app/Http/Controllers/CommentController.php
  2. Comment Model : https://github.com/goodman77/laravel_comments/blob/master/app/Comment.php
  3. Main Laypout Template: https://github.com/goodman77/laravel_comments/blob/master/resources/views/layout/app.blade.php
  4. Sub Comment Template : https://github.com/goodman77/laravel_comments/blob/master/resources/views/comments/main.blade.php
  5. Post Comment Template : https://github.com/goodman77/laravel_comments/blob/master/resources/views/post/comments.blade.php
  6. Jquery script file: https://github.com/goodman77/laravel_comments/blob/master/resources/assets/js/script.js
    Note: I didnt use any Javascript template language , I guess it would have been easier I just defined my template in javascript as a constant and used it in the Jquery Ajax call.
