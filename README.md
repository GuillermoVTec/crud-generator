# 🧰 Laravel CRUD Generator by Guillermo Tec

Este paquete permite generar CRUDs completos de forma automática en tus proyectos Laravel con un solo comando Artisan.

🔧 Ideal para acelerar el desarrollo de paneles administrativos, sistemas personalizados, prototipos y MVPs.

---

## 🚀 Características

Genera automáticamente:

- 🧠 Modelo (`app/Models`)
- ⚙️ Controlador (`app/Http/Controllers`)
- 🧱 Migración con los campos definidos (`database/migrations`)
- 📄 Vistas Blade (`resources/views`): `index`, `create`, `edit`
- 🛤️ Sugerencia de ruta para agregar en `routes/web.php`

✔ Usa stubs personalizables para tener control completo sobre el código generado.

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
Luego instala el paquete con:

bash
Copiar
Editar
composer require guillermovenanciotecucan/crud-generator:dev-main
📦 Uso del comando
bash
Copiar
Editar
php artisan make:crud NombreDelModelo --fields="campo1:string,campo2:integer"
🔹 Ejemplo:

bash
Copiar
Editar
php artisan make:crud Producto --fields="nombre:string,precio:decimal"
Genera:

app/Models/Producto.php

app/Http/Controllers/ProductoController.php

resources/views/productos/index.blade.php

resources/views/productos/create.blade.php

resources/views/productos/edit.blade.php

database/migrations/xxxx_xx_xx_create_productos_table.php

📌 También te sugerirá automáticamente la línea que puedes copiar en routes/web.php:

php
Copiar
Editar
Route::resource('productos', ProductoController::class);
✏️ Personalización
Puedes publicar los stubs para modificarlos a tu gusto:

bash
Copiar
Editar
php artisan vendor:publish --tag=crud-stubs
📄 Licencia
Este proyecto está bajo la licencia MIT.

👨‍💻 Autor
Guillermo Venancio Tec Ucan
📧 guillermo.v.tec.ucan@gmail.com

¡Gracias por usar este generador! Si te resultó útil, compártelo con otros desarrolladores 🚀