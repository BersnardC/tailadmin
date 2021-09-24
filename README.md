<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Instalar dependencias

Para instalar las dependencias del proyecto es necesario tener instalado composer y ejecutar:

- composer install.


## Base de Datos y migraciones

Para ejecutar el entorno de datos correctamente es necesario crear una base de datos en mysql y seguir los siguientes pasos

- Añadir el nombre de la base de datos en el archivo en, en la variable: DB_DATABASE
- Añadir credenciales de servidor de base de datos en archivo env (usuario, password, puerto, host)
- Ejecutar: *php artisan migrate*

## Levantando el proyecto

Una vez configurada el servidor de base de datos y las migraciones solo se debe ejecutar:

- *php artisan serve*
- Abrir http://127.0.0.1:8000 en el navegador
- Ir al link *Cargar datos*

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
