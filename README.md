![Queater](https://lh3.googleusercontent.com/keep-bbsk/AFgXFlJC6A8TQqXZ9-ZJskb7LUum3hyo4hdV7_gywikP4egZZ82Tka-Os7tTh2dI5SaBlP_T2meAhpNlOdJlre1MK-cN1gI-oq8VJOWrhEagdb1b5N3pdBEFpQ=s512)




## Capturas de pantalla
![App Screenshot](https://lh3.googleusercontent.com/keep-bbsk/AFgXFlJmd9xMXS6QihA6jgfK4pMxYAo7lhbPxSLP3ecRLHIhnraU_9MbZRbWEcpaFRcRLOVOR4myooAMNpNNBn92JBNCgkFawVmEoFZpH5GrBlojrnhHI1Od1w=s512) 


![App Screenshot](https://lh3.googleusercontent.com/keep-bbsk/AFgXFlIoNirlI9s66FjFNfVwXjlhV_Au1oGLFQc4O2Z0GMF_vn8U6DEsPeMPM0nLzvuvcpy1kG7ya-h7yef_Yv1ktyzGe8dPThL4y1H9wKo62r14Fmi33mAWdg=s1600)

![App Screenshot](https://lh3.googleusercontent.com/keep-bbsk/AFgXFlL2RmlwLLvgtI8Vn9-aKWAuO_cbRx-344NaHitdLgZMifx182HTvRghbrkE9q8S52nBse-CjLzr2yBUVO89AH5y0fcMjRsjJigkrOSj5xt-tbo9DSwIcA=s1600)

![App Screenshot](https://lh3.googleusercontent.com/keep-bbsk/AFgXFlJF3Z1YDJa3aYp616OO74KedjyfWzPIsbN7ey_NmGIz8cIl2vt8NNLKSsBFvLYQ_J9YCImX5CdjgM7OQREM7LrPpxT5xSlapr1mqlhPvzc5NbTt4rNFow=s1600)









## Queater: Una aplicación web para agilizar el servicio en restaurantes

###  Descripción del proyecto


Queater es una aplicación web diseñada para optimizar el servicio en restaurantes, reduciendo la carga de trabajo de los camareros y brindando mayor autonomía a los clientes. La aplicación funciona mediante el escaneo de un código QR ubicado en cada mesa del restaurante. Al escanear el QR, los clientes acceden a una interfaz web en la que pueden visualizar el menú del restaurante, seleccionar los productos que desean y realizar su pedido.

### Características principales ⭐

- Pedido digital: Los clientes pueden realizar sus pedidos de forma rápida y sencilla a través de la web, sin necesidad de esperar a que un camarero los atienda.

- Menú digital: La aplicación muestra el menú completo del restaurante, incluyendo imágenes y descripciones de los platos.

- Pago en línea: Los clientes pueden pagar su pedido de forma segura a través de la web, utilizando diferentes métodos de pago.

- Notificaciones en cocina y caja: El personal de cocina y caja recibe notificaciones instantáneas de los nuevos pedidos, lo que les permite prepararlos y procesarlos de manera eficiente.

- Pedidos para llevar o para comer en el lugar: Los clientes pueden indicar si desean su pedido para llevar o para comer en el restaurante.

- Interfaz amigable: La aplicación web cuenta con una interfaz intuitiva y fácil de usar, tanto para los clientes como para el personal del restaurante.

### Beneficios ✅

Queater ofrece una serie de beneficios tanto para los clientes como para los restaurantes:

#### Para los clientes:

- Mayor rapidez y comodidad

- Autonomía y control

- Menos errores
#### Para los restaurantes:

- Reducción de la carga de trabajo de los camareros

- Mayor eficiencia en la cocina

- Aumento de las ventas

- Mejora de la imagen del restaurante

### Conclusión

Queater es una aplicación web innovadora que ofrece una solución integral para optimizar el servicio en restaurantes, mejorando la experiencia tanto para los clientes como para el personal. La aplicación se presenta como una herramienta valiosa para aumentar la eficiencia, reducir costos y mejorar la satisfacción del cliente en el sector de la restauración.





# 🚀 Cómo ejecutar Queater:

## Requisitos previos:

- GIT
- PHP: extensiones, curl, ftp, fileinfo, gd, gmp, imap, mbstring, mysqli,openssl, pdo_mysql, pdo_pgsql y pgsql
- Mysql
- Node.js
- Composer


## Pasos:


#### ⬇️ Descargar Queater

Abre tu terminal y ejecuta el siguiente comando:

    git clone https://github.com/brianrddaw/Queater.git


#### 📄 Configurar .env

- Renombra el archivo .env.example a .env.

- Modifica el archivo .env con las credenciales para acceder a tu base de datos en Mysql.
    

#### ⚙️ Instalar dependencias:

Accede a la carpeta del proyecto clonado y ejecuta los siguientes comandos:

    composer install
    npm install


#### ✏️ Crear las bases de datos

Crear las siguientes bases de datos en Mysql

    CREATE DATABASE queater
    CREATE DATABASE queater_test

#### 🔧 Preparar el proyecto para su ejecución

Crea el enlace simbólico entre public y storage

    php artisan storage:link

Ejecutar las migraciones.

	php artisan migrate

Ejecutar los test.

    php artisan test


Opcional: Crear tu propio admin para queater.

- Dirígete al archivo DatabaseSeeder.php.(database/seeders/DatabaseSeeder.php)

- Modifica el nombre, el email y la contraseña a tu gusto.

Si no haces este paso, el usuario para acceder a dashboard y kitchen será “admin” , el email “admin@admin.com” y la contraseña “admin”

#### 🚀 Ejecutar el proyecto

En dos terminales diferentes ejecuta los siguientes comandos

    php artisan serve
    npm run dev

### ¡Detalles a tener en cuenta!
#### Para poder hacer pedidos desde mesas deberás crear al menos una mesa en el apartado de "Generar QR" en dashboard.


### Rutas: 
- http://127.0.0.1:8000/dashboard -> para acceder al panel de control donde podrás crear,editar y eliminar productos, categorías y mesas.

- http://127.0.0.1:8000/kitchen -> podras ver los pedidos que se hagan con actualización constante, cuando un pedido este hecho podrás cambiar su estado

- http://127.0.0.1:8000/cash -> podrás ver info de todos los pedidos que estén en cola(están haciendo en cocina) y pedidos terminados listos para entregar que sean para comer en el sitio y para llevar.

- Para hacer pedidos para comer en el sitio debes dirigirte manualmente al url: http://127.0.0.1:8000/eat-here/1 -> para la mesa numero 1, si quieres otra mesa solo tienes que cambiar el último numero.

- Para hacer pedidos para llevar: http://127.0.0.1:8000/take-away  


#### Para pagar un pedido utiliza un número de tarjeta de pruebas: 4242 4242 4242 4242, el resto de campos los puedes rellenar con datos falsos siempre y cuando sean válidos

Siguiendo estos pasos, podrás ejecutar Queater en tu ordenador local y comenzar a explorar las funcionalidades de la aplicación.

# 🗃️ Documentación de Queater: 

Diagrama Entidad-Relación: https://t.ly/Epba3

Diagrama de clases: https://t.ly/rPzoG

Pantallas de diseño: https://t.ly/8iQrz







# 👱🏻‍♂️👦🏻 Autores

[@brianrddaw](https://github.com/brianrddaw)

[@MiguelAguiarDEV](https://github.com/MiguelAguiarDEV)


# 🔗 Linkedin

Brian Ramírez

[![linkedin](https://media.licdn.com/dms/image/D4D03AQGgJJTvyWts4A/profile-displayphoto-shrink_200_200/0/1701608995216?e=1719446400&v=beta&t=xfvE3be57gXWwaDbgAL5mqMVeMPgzEH_jHhdzd5MTag)](https://www.linkedin.com/in/brian-ram%C3%ADrez-delgado-62b3a62a3/)

Miguel Aguiar

[![linkedin](https://media.licdn.com/dms/image/D4E03AQHOVtFHhrFNkQ/profile-displayphoto-shrink_200_200/0/1705395635606?e=1719446400&v=beta&t=As25zAAPFBbMxBHHl9PGEASTqFsOtGaigH5J9yLy8qA)](https://www.linkedin.com/in/miguel-alejandro-santiesteban-aguiar/)

