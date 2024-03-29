php artisan serve
php artisan migrate
php artisan -h make:migration   -za pomoć  -za napraviti novu migraciju/tablicu
php artisan make:migration    

npr: - kreairea TABLE 'posts'
php artisan make:migration create_posts_table

Kreiranje modela 'Post' u app folderu
Model je konekcija/veza prema bazi
php artisan make:model Post

Kreiranje kontrolera u app/http/controllers folderu
php artisan make:controller PostController

KReiranje autorizacijskog modula
php artisan make:auth

Kreiranje kontrolera u app/http/controllers folderu - napuni controller sa metodama (naredba -r)
php artisan make:controller UserController -r

php artisan migrate:refresh

composer require cviebrock/eloquent-sluggable:^4.8

php artisan make:model Comment -a

//Dodaje polje user_id u comments table
php artisan make:migration add_user_id_to_comments --table=comments

//Mailgun instalacija
composer require guzzlehttp/guzzle


php artisan make:mail Welcome --markdown=emails.welcome

//Ponovno povlači cache ako smo radili promjene u .env fajli
php artisan config:cache

//Kreiranje Tagova "-a" -a označava da kreira factory, model, migraciju
php artisan make:model Tag -a
\database\migrations\create_tags_tabel smo nadopunili
php artisan migrate


