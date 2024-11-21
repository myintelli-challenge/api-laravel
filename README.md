# API Laravel

## **📋 Prerequisitos**

Antes de iniciar con la ejecución del proyecto, debe tener instalado:

- **PHP v7+**
- **Laravel 5.8**
- **PostgreSQL 13**

## **💻 Ejecución**

Al ingresar al proyecto ejecutar los siguientes comandos, para instalar librerías, ejecutar migración de tablas y levantamiento del proyecto

```bash
composer install
php artisan migrate
php artisan serve
```

Una vez se ejecute el comando final, el proyecto estará corriendo en el puerto 8000

## **🚀 API**

Se adjunta en el correo un archivo JSON con la colección generada en PostMan con las peticiones necesarias, para las peticiones que lo requieran existe el request en el BODY

**Módulo de usuarios**
- Registro de usuarios :POST(/api/register)
- Login que generará el JWT :POST(/api/login)

**Autores**
- Crear un autor :POST(/api/autor)
- Obtener autores creados :GET(/api/autores)
- Editar autor :PUT(/api/autor/{id_autor})
- Eliminar autor :DELETE(/api/autor/{id_autor})

**Libros**
- Crear un libro :POST(/api/libro)
- Obtener libros creados :GET(/api/libros)
- Editar libro :PUT(/api/libro/{id_libro})
- Eliminar libro :DELETE(/api/libro/{id_libro})

**Exportar**
- Exportar documento con información de autores y libros :GET(/api/exportar)

