# Technokey Tech Assessment

Este proyecto es una aplicación web desarrollada como parte de la evaluación técnica para Technokey. Proporciona funcionalidades relacionadas con la gestión de vuelos.

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
Asegúrate de ajustar [web-server-path] para que coincida con la ruta real en tu entorno de servidor web.
Inicio del Proyecto

Una vez que hayas instalado las dependencias con Composer y configurado Apache según las instrucciones anteriores, puedes iniciar el proyecto accediendo a través de tu servidor web local. Por ejemplo, si estás usando Apache localmente, accede a http://localhost/technokey-tech-assesment/public.

Uso
Rutas Disponibles: El proyecto utiliza un sistema de rutas que puedes explorar para acceder a diferentes funcionalidades. Las rutas están definidas en el archivo routes/web.php.

Funcionalidades: El proyecto incluye controladores para manejar diferentes aspectos como autenticación de usuarios, gestión de vuelos, entre otros. Explora los controladores en el directorio app/controllers para más detalles.
