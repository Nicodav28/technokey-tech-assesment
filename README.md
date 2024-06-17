# Technokey Tech Assessment

Este proyecto es una aplicación web desarrollada como parte de la evaluación técnica para Technokey. Proporciona funcionalidades relacionadas con la gestión de vuelos.

## Tecnologías Utilizadas

- PHP 8.0
- PostgreSQL

## Instrucciones de Instalación

1. **Instalación de Dependencias**
   - Antes de comenzar, asegúrate de tener [Composer](https://getcomposer.org/) instalado en tu sistema.
   - Abre una terminal o línea de comandos en el directorio raíz de tu proyecto y ejecuta el siguiente comando para instalar todas las dependencias necesarias:

     ```
     composer install
     ```

2. **Configuración de Apache**

   Para que el sistema de rutas del proyecto funcione correctamente, debes realizar los siguientes ajustes en la configuración de Apache:

   **DocumentRoot y Directory para Apache:**

   Asegúrate de que la configuración de tu VirtualHost o el archivo de configuración principal de Apache (`httpd.conf` o `httpd-vhosts.conf` dependiendo de tu entorno) contenga las siguientes líneas, reemplazando `[web-server-path]` con la ruta correspondiente en tu configuración:

   ```apache
   DocumentRoot "C:/[web-server-path]/technokey-tech-assesment/public"
   <Directory "C:/[web-server-path]/technokey-tech-assesment/public">
       Options Indexes FollowSymLinks Includes ExecCGI
       AllowOverride All
       Require all granted
   </Directory>
   ```

   Asegúrate de ajustar `[web-server-path]` para que coincida con la ruta real en tu entorno de servidor web.
    Para agregar la información sobre la configuración de la conexión a la base de datos en un archivo `.env` y asegurar que el usuario que clone el repositorio cree este archivo, puedes seguir estos pasos adicionales:

3. **Configuración de la Base de Datos**
    
    Este proyecto requiere una conexión a una base de datos PostgreSQL. Asegúrate de crear un archivo `.env` en el directorio raíz del proyecto con la siguiente configuración, reemplazando los valores según tu entorno local:
    
    ```dotenv
    # Configuración de conexión a la base de datos PostgreSQL
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=nombre_basedatos
    DB_USERNAME=usuario_basedatos
    DB_PASSWORD=contraseña_basedatos
    ```
    
    **Notas Importantes**
    Asegúrate de tener PostgreSQL instalado y configurado correctamente en tu sistema y de haber creado la BD correspondiente con ayuda del archivo que se haya en este repositorio "DB_Query.txt".
    
4. **Inicio del Proyecto**

   Una vez que hayas instalado las dependencias con Composer y configurado Apache según las instrucciones anteriores, puedes iniciar el proyecto accediendo a través de tu servidor web local. Por ejemplo, si estás usando Apache localmente, accede a `http://localhost/technokey-tech-assesment/public`.

## Uso

- **Rutas Disponibles:** El proyecto utiliza un sistema de rutas que puedes explorar para acceder a diferentes funcionalidades. Las rutas están definidas en el archivo `routes/web.php`.

- **Controladores y Modelos:** El directorio `app/controllers` contiene los controladores que manejan la lógica de la aplicación, mientras que `app/models` contiene los modelos que interactúan con la base de datos PostgreSQL.

- **Middleware:** La carpeta `app/middleware` contiene los middleware utilizados para procesar las solicitudes antes de que lleguen a los controladores.

- **Configuración:** El directorio `config` contiene archivos de configuración importantes para la aplicación.
