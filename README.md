Sistema que cria sistemas de CRUD com add-ons.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# erro 1
```
The "https://repo.packagist.org/p2/symfony/error-handler.json" file could not be downloaded: SSL: Handshake timed out
  Failed to enable crypto
  failed to open stream: operation failed
```
```
composer config --global disable-tls true
composer config --global secure-http false
```
Adicionar "secure-http": falso no arquivo composer.json
```
"config": {
    "secure-http": false
},
```
```
composer clear-cache
composer diagnose
```
# erro 2
`sudo chmod -R 777 /var/www/html/development/storage`
# erro 3
`sudo chmod -R 777 /var/www/html/development/bootstrap/cache`
# erro 4
comment DB_DATABASE in .env.
https://stackoverflow.com/questions/30382554/sqlite-unable-to-open-database-file-laravel-windows
# erro 5
install dbal version 2 `composer require doctrine/dbal:2.13`. 
https://stackoverflow.com/questions/33002659/laravel-5-1-class-doctrine-dbal-driver-pdosqlite-driver-not-found
# erro 6
enble mod rewrite `sudo a2enmod rewrite` and put `AllowOverride All` nas configs apache na pasta do sistema web. 
https://stackoverflow.com/questions/36303706/url-was-not-found-on-this-server-laravel
# debug
`dd($clientes);`
# ...
```php
protected static function booted()
{
    static::retrieved(function ($model) {
        $model->what(); //called once all attributes are loaded
    });
}
```
# link doc expanded
https://laravel.com/api/8.x/index.html
# update line without update any field
`$user->touch();`
# Codes
```
composer install
php artisan cache:clear && php artisan config:clear && php artisan view:clear && php artisan route:clear
php artisan migrate:refresh --seed
php artisan clear-compiled && composer dump-autoload && php artisan optimize
npm run watch
npm install && npm run dev
qodana scan -l jetbrains/qodana-php:2022.2-eap --show-report
php artisan make:model Agreement
php artisan make:migration create_agreement_table
```
## Develop
 - Install Docker Engine to Qodana
 - Install Qodana (JetBrains)
 
# outputs command line
> @php artisan package:discover --ansi

   INFO  Discovering packages.

  laravel/breeze ................................................................................................ DONE
  laravel/sail .................................................................................................. DONE
  laravel/sanctum ............................................................................................... DONE
  laravel/tinker ................................................................................................ DONE
  nesbot/carbon ................................................................................................. DONE
  nunomaduro/collision .......................................................................................... DONE
  nunomaduro/termwind ........................................................................................... DONE
  spatie/laravel-ignition ....................................................................................... DONE

# Escolha do nome Enter
 - SignIn não foi aceito pois existe SignUp e ambos referem-se a acessar o sistema.
 - Login não foi aceito pois existe Logon e ambos referem-se a acessar o sistema.

# blackroute
Internet Provider System
## Business
Projeto arquivado pois não tem como concorrer com o MK-Auth com preços tão baixos e ambições tão altas.
## Codes
### Principais
```
php artisan cache:clear && php artisan config:clear && php artisan view:clear && php artisan route:clear
php artisan migrate:refresh --seed
php artisan clear-compiled && composer dump-autoload && php artisan optimize
npm run watch
npm install && npm run dev
qodana scan -l jetbrains/qodana-php:2022.2-eap --show-report
```
### Others
```
php artisan make:model Agreement
php artisan make:migration create_agreement_table
```
### Develop
 - Install Docker Engine to Qodana
 - Install Qodana (JetBrains)
