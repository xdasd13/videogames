# Sistema de Gestión de Usuarios - CodeIgniter 4

Sistema de gestión de usuarios desarrollado con CodeIgniter 4, implementando arquitectura MVC y siguiendo las mejores prácticas de desarrollo.

## Características

- Autenticación de usuarios
- Registro de nuevos usuarios
- Gestión de perfiles
- Carga de avatares
- Panel de administración
- Sistema de roles (admin/usuario)
- Validación de formularios
- Manejo de sesiones
- Encriptación de contraseñas

## Requisitos Previos

- PHP 8.0 o superior
- MySQL 5.7 o superior
- Composer
- Apache/Nginx
- Extensiones PHP requeridas:
  - intl
  - json
  - mbstring
  - mysqlnd
  - xml
  - curl

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/tuusuario/videogames.git
cd videogames
```

2. Instalar dependencias:
```bash
composer install
```

3. Configurar el entorno:
   - Copiar `env` a `.env`
   - Actualizar las credenciales de la base de datos en `.env`:
```
database.default.hostname = localhost
database.default.database = videogames
database.default.username = tu_usuario
database.default.password = tu_contraseña
```

4. Crear la base de datos:
```sql
CREATE DATABASE miapp;
```

5. Ejecutar las migraciones:
```bash
php spark migrate
```

6. Ejecutar el seeder para crear usuarios de prueba:
```bash
php spark db:seed SUsuarios
```

7. Configurar el servidor web:
   - Apuntar el DocumentRoot a la carpeta `public/`
   - Asegurarse que el módulo rewrite está habilitado

## Configuración del Host Virtual

### Apache
```apache
<VirtualHost *:80>
    ServerName videogames.test
    DocumentRoot "C:/xampp/htdocs/videogames/public"
    <Directory "C:/xampp/htdocs/videogames/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### Archivo hosts
Agregar en `C:\Windows\System32\drivers\etc\hosts`:
```
127.0.0.1 videogames.test
```

## Estructura de Directorios

```
videogames/
├── app/
│   ├── Config/
│   ├── Controllers/
│   ├── Database/
│   │   ├── Migrations/
│   │   └── Seeds/
│   ├── Filters/
│   ├── Models/
│   └── Views/
├── public/
│   └── images/
│       └── avatar/
└── writable/
```

## Usuarios por Defecto

1. Administrador:
   - Usuario: admin
   - Contraseña: admin123

2. Usuario Regular:
   - Usuario: usuario1
   - Contraseña: user123

## Funcionalidades Principales

1. Autenticación:
   - Login: `http://videogames.test/login`
   - Registro: `http://videogames.test/register`
   - Logout: `http://videogames.test/logout`

2. Gestión de Perfil:
   - Ver perfil: `http://videogames.test/profile`
   - Actualizar avatar
   - Ver información personal

3. Administración:
   - Lista de usuarios: `http://videogames.test/users` (solo admin)
   - Gestión de roles

## Seguridad

- Contraseñas encriptadas con `password_hash()`
- Protección contra CSRF
- Validación de formularios
- Filtros de autenticación
- Manejo seguro de sesiones
- Protección de rutas

## Mantenimiento

Para limpiar la caché y archivos temporales:
```bash
php spark cache:clear
```

Para actualizar la base de datos después de cambios:
```bash
php spark migrate:refresh
php spark db:seed SUsuarios
```

## Resolución de Problemas

1. Error de permisos:
   - Asegurar que las carpetas `writable/` y `public/images/avatar/` tienen permisos de escritura

2. Error de base de datos:
   - Verificar las credenciales en `.env`
   - Confirmar que el servicio MySQL está corriendo

3. Error 404:
   - Verificar la configuración del host virtual
   - Comprobar que mod_rewrite está habilitado

## Convenciones de Código

Este proyecto sigue:
- PSR-12 para estándares de código
- Convenciones de nombres de CodeIgniter 4
- Arquitectura MVC

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
