From the root directory of project via commandline run,

1. $  composer install -d workbench/acme/cart

2. $  composer dump-autoload

3. $  composer update

4. change database settings in database.php to match your database

5. run sentry migrations via, ( if you already have database from last chapter remove all tables as sentry will conflict with users table )

   $  php artisan migrate --package=cartalyst/sentry

6. run migrations via 

	$ php artisan migrate 

to get all tables for the chapter.

7. for stripe integration

$ php artisan config:publish abodeo/laravel-stripe 
and add your keys in config file generated at,

app/config/abodeo/laravel-stripe/stripe.php

return array(
  'api_key' => 'my-api-key',
  'publishable_key' => 'my-pub-key'
);

you can get both keys via registring at stripe.com

---------------------
view routes.php file to check possible options to explore.

enjoy :)