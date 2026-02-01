# Documentación Proyecto PHP 2º Ev.

**Parrita's VideoStore** 

## Descripción

Proyecto Ecommerce desarrollado en Laravel para la venta de videojuegos y accesorios, con sistema de usuarios, carrito, lista de deseados y panel de administración.

Permite a los usuarios navegar por el catálogo, comparar productos, añadir artículos al carrito y guardar favoritos. Los administradores pueden gestionar productos desde un panel.

## Tecnologías utilizadas

- PHP 8.1
- Laravel
- MySQL
- Bootstrap
- Composer
- Docker
- Tailwind CSS
- Vite

## Funcionalidades 

#### Usuarios

- Registro e inicio de sesión
- Ver productos, ofertas y categorias
- Carrito de compra
- Lista de deseados
- Comparador de productos

#### Administradores

- CRUD de productos.

## Mejoras implementadas

En este proyecto, se han implementado 2 mejoras respecto a su estructura inicial, con la intención de mejorar su funcionalidad.

- **Buscador de Productos**: Se ha implementado un sistema de búsqueda en la vista de productos (/products) que permite a los usuarios filtrar los productos por nombre. El buscador realiza una búsqueda que filtra los productos cuyo nombre contiene el término de búsqueda introducido, facilitando la localización rápida de productos específicos en el catálogo.

- **Sistema de Comparación de Productos**: Se ha implementado un comparador de productos que permite a los usuarios seleccionar dos productos y compararlos lado a lado, mostrando información detallada como precio, marca, plataforma, tipo, stock y categoría. Esto facilita la toma de decisiones de compra al permitir una comparación visual y directa entre productos similares.

## Estructura del proyecto

Tenemos una estructura principal como la que sigue, especificando solo las subcarpetas y subficheros más importantes:

- **root:**
  - **app**
  - **bootstrap**
  - **config**
  - **database**
  - **node_modules**
  - **public**
  - **resources**
  - **routes**
  - **storage**
  - **tests**
  - **vendor**
  - Ficheros: .editorconfig, .env, .env.example, .gitignore, .phpcs.xml, artisan, compose.yaml, composer.json, composer.lock, package-lock.json, package.json, phpstan.neon, phpunit.xml, pint.json, postcss.config.js, tailwind.config.js, vite.config.js

## Instrucciones de instalación

1. Primero, ha de clonarse el proyecto de github (https://github.com/parra1996/myshop_laravel).

2. Después, instalamos sail, copiamos el .env de ejemplo y añadimos sail a los alias de linux:
```bash
php artisan sail:install --with=mysql,redis
cp .env.example .env
php artisan key:generate

echo "alias sail='./vendor/bin/sail'" >> ~/.bashrc
source ~/.bashrc
```

3. En el .env, rellenamos estos campos:
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=myshop
DB_USERNAME=sail
DB_PASSWORD=password
```

4. Levantamos los contenedores mediante un comando sail:
```bash
sail up -d --build
```

5. Accedemos al contenedor de mysql para darle permisos a la aplicación (con usuario sail) para gestionar nuestra base de datos, que llamaremos "myshop":
```bash
# Da el nombre de contenedor
docker ps --format "table {{.Names}}\t{{.Image}}" | grep -i mysql
# Accedemos a mysql
docker exec -it nombre-contenedor mysql -u root -password
```

6. Dentro de MySQL, ejecutamos:
```sql
CREATE DATABASE IF NOT EXISTS myshop;
GRANT ALL PRIVILEGES ON myshop.* TO 'sail'@'%';
FLUSH PRIVILEGES;
# Después, salimos de mysql
exit
```

7. Poblamos la base de datos con datos iniciales:
```bash
sail artisan migrate:refresh --seed
```

8. Instalamos dependencias:
```bash
sail npm install
```

## Uso Básico

### Navegación

Por un lado, podemos acceder a las vistas principales mediante el menú de navegación en la parte superior, a las vistas "Inicio", "Productos", "Categorías", "Ofertas", "Contacto", "Comparar Productos" y "Dashboard" (o "Login" y "Registro" si se trata de un usuario no autenticado).

Por otro lado, desde cada una de estas vistas principales podemos acceder a los elementos específicos de cada sección, como un producto, categoría, u ofertas, o a la sección de artículos actualmente en oferta.

Finalmente, desde el "Dashboard", como usuario autenticado, podemos acceder a la gestión de productos, situada en `/admin/products` o a la sección de "Lista de Deseados", donde podemos ver nuestros productos marcados como favoritos.

## Vistas Públicas

### Página de Inicio

En la vista principal `/` (welcome), los usuarios pueden ver una página de bienvenida con información sobre la tienda, categorías destacadas y enlaces rápidos a productos y ofertas especiales.

### Login y Registro

Los usuarios pueden usar la mayoría de la aplicación web sin iniciar sesión, a excepción de la gestión de productos y el acceso a la "Lista de Deseados". Para autenticarse, existen las siguientes vistas gestionadas mediante Laravel Breeze:

- **Login** (`/login`): Permite a los usuarios iniciar sesión con su email y contraseña.
- **Registro** (`/register`): Permite crear una nueva cuenta de usuario.
- **Recuperar Contraseña** (`/forgot-password`): Permite solicitar un enlace para restablecer la contraseña olvidada.
- **Restablecer Contraseña** (`/reset-password/{token}`): Permite establecer una nueva contraseña usando el token recibido por email.

### Ver Productos

Todos los usuarios pueden ver los productos en `/products` y `/products-on-sale` (mostrando solo aquellos en oferta), mostrando su precio actual y anterior a una posible rebaja, cualquier oferta que tengan, y su nombre, imagen y descripción. Los productos incluyen información adicional como plataforma, marca (Sony, Microsoft, Nintendo, PC), tipo (juego o accesorio) y stock disponible.

Además, desde esa vista pueden pulsar en el botón "Ver Detalles" de cualquier producto e ir a la vista de `/products/{id}`, donde se pueden apreciar más detalles, como el stock, y una imagen más amplia del producto.

### Comparar Productos

En la vista `/compare`, los usuarios pueden seleccionar dos productos de la lista desplegable y compararlos lado a lado. El comparador muestra información detallada de ambos productos incluyendo precio (con descuentos aplicados si los hay), marca, plataforma, tipo, stock y categoría, facilitando la toma de decisiones de compra.

### Categorías

En la vista `/categories` se pueden ver todas las categorías de productos disponibles, y un botón de "Ver Productos" para acceder a los productos de cada categoría en `/categories/{id}`. Cada una de las categorías posee una pequeña descripción para orientar a los usuarios.

### Ofertas

En la vista de ofertas en `/offers` tenemos la lista de ofertas, junto a sus respectivos descuentos. Los usuarios pueden ver una mayor descripción y la lista de productos afectados por dichas ofertas al pulsar en el botón de "Ver Productos" de cada una e ir a `/offers/{id}`, donde se muestra todo con mayor detalle.

### Carrito

Desde la vista de `/cart`, los usuarios pueden ver la lista de productos de su carrito, modificar la cantidad de los mismos, eliminarlos del carrito, o proceder al pago mediante el botón de checkout. Se muestra el precio resultante, así como los precios previos a las rebajas aplicadas por las ofertas.

### Contacto

Desde la vista de `/contact`, los usuarios pueden ver las distintas formas de comunicarse con nosotros a través de distintas plataformas, ya sea por correo, por llamada telefónica y muy pronto implementaremos un chat en vivo. Además podrán seguirnos en nuestras redes sociales ofreciéndoles enlaces para nuestras cuentas de X, Instagram y Meta.

## Vistas de Usuario Autenticado

### Dashboard

En la vista `/dashboard`, los usuarios autenticados pueden acceder a un panel de control que les permite navegar a las diferentes secciones de gestión disponibles, como la gestión de productos y la lista de deseados.

### Perfil de Usuario

Los usuarios autenticados pueden gestionar su perfil desde la vista `/profile`:

- **Editar Perfil** (`/profile`): Permite actualizar la información del perfil del usuario, incluyendo nombre y email.
- **Cambiar Contraseña**: Permite actualizar la contraseña de la cuenta.
- **Eliminar Cuenta**: Permite eliminar permanentemente la cuenta de usuario.

### Verificar Email

Los usuarios nuevos deben verificar su dirección de email. La vista `/verify-email` permite solicitar un nuevo enlace de verificación si no se recibió el correo inicial.

### Confirmar Contraseña

Algunas acciones sensibles requieren confirmar la contraseña. La vista `/confirm-password` permite verificar la identidad del usuario antes de realizar estas acciones.

## Vistas de Administración

### Gestionar Productos

Como usuario autenticado, es posible acceder a `/admin/products` para poder gestionar los productos de la tienda online:

- **Lista de Productos** (`/admin/products`): Muestra todos los productos disponibles con opciones para crear, editar o eliminar.
- **Crear Producto** (`/admin/products/create`): Permite añadir un nuevo producto a la tienda, incluyendo la subida de imágenes.
- **Editar Producto** (`/admin/products/{id}/edit`): Permite modificar la información de un producto existente, incluyendo la actualización de su imagen.

La aplicación web tiene capacidad para, además de gestionar los productos en sí en la base de datos, subir ficheros de imágenes de los mismos, permitiendo una mayor visibilidad y funcionalidad. Los productos pueden incluir información como nombre, descripción, precio, categoría, oferta asociada, plataforma, marca, tipo y stock.

### Lista de Deseados

Un usuario autenticado, desde la vista específica de producto en `/products/{id}`, puede añadir dicho elemento a su lista de deseados. Más tarde, desde dicha lista en `/admin/wishlist`, podemos ver todos nuestros productos favoritos y añadir cualquiera de ellos a nuestro carrito para poder comprarlos.

## Autor

**Juan Pablo Parra Labarca**

GitHub: https://github.com/parra1996/myshop_laravel

