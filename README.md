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
