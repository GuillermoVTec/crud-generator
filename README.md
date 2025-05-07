# 🧰 Laravel CRUD Generator by Guillermo Tec

Este paquete permite generar CRUDs completos de forma automática en tus proyectos Laravel con un solo comando Artisan.

🔧 Ideal para acelerar el desarrollo de paneles administrativos, prototipos y sistemas personalizados.

---

## 🚀 Características

- Crea automáticamente:
  - 🧠 Modelo (`app/Models`)
  - ⚙️ Controlador (`app/Http/Controllers`)
  - 📄 Vistas Blade (`resources/views`)
  - 🛤️ Rutas (puedes agregarlas fácilmente con `Route::resource`)
  - 🧱 Migración con campos definidos

- Usa stubs personalizables para control total sobre la estructura del código generado.

---

## 🛠 Requisitos

- Laravel 8, 9 o 10
- PHP 7.4 o superior

---

## ⚙️ Instalación (modo local)

En el `composer.json` de tu proyecto Laravel, agrega:

```json
"repositories": [
  {
    "type": "path",
    "url": "../laravel-packages/crud-generator"
  }
]


luego ejecuta 
composer require guillermovenanciotecucan/crud-generator:dev-main

uso de comando
php artisan make:crud NombreDelModelo --fields="campo1:string,campo2:integer"
ejempo 
php artisan make:crud Producto --fields="nombre:string,precio:decimal"

Genera:

app/Models/Producto.php

app/Http/Controllers/ProductoController.php

resources/views/productos/

Migración create_productos_table


puedes publicar los stubs para editarlos desde tu proyecto 

php artisan vendor:publish --tag=crud-stubs

 Licencia
Este proyecto está bajo la licencia MIT.
Autor
Guillermo Venancio Tec Ucan
guillermo.v.tec.ucan@gmail.com

¡Gracias por usar este generador!


---


