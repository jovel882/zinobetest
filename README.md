# Prueba de desarrollo directorio de usuarios

_Prueba de desarrollo para Zinobe._


### Pre-requisitos 📋

_Ambiente requerido_

- Apache 2.4.29 con mod_rewrite habilitado.
- Php 7.2.0 con phpCli habilitado para la ejecucion de comando.
- Mysql 5.7.19.
- Composer 

### Instalación 🔧

1. Clonar el repositorio en el folder del servidor web en uso, **este folder debe terner permisos para que php se pueda ejecutar por CLI y permisos de lectura y escritura para el archivo .env**.

`git clone https://github.com/jovel882/zinobetest.git`

1. Instalar paquetes.

`composer install`

1. Crear BD con COLLATE 'utf8mb4_general_ci', ejemplo.

`CREATE DATABASE users /*!40100 COLLATE 'utf8mb4_general_ci' */`

1. Configurar variables de entorno y migrar BD, cambie los datos deacuerdo a lo configurado previamente.

`php config.php ENV="production" DDBB_HOST="localhost" DDBB_USER="root" DDBB_PASSWORD="" DDBB="users"`

### **Uso comando config.php :**
Este comando recibe los siguentes parametros, ninguno debe contener espacios:
- `ENV="value"` Variable de entorno para el nombre del entorno.
- `DDBB_HOST="value"` Variable de entorno para el host de BD.
- `DDBB_USER="value"` Variable de entorno para el usuario de BD.
- `DDBB_PASSWORD="value"` Variable de entorno para la contraseña de BD.
- `DDBB="value"` Variable de entorno para el nombre de BD.
##### Nota: 
Estos deben suministrarse todos para configurar las variables de entorno, si alguno falta no se cargara ninguno y el archivo .env permanecera igual.

- `--notDbMigrate` Bandera que indica que no se eliminen las tablas y se carguen los datos de ejemplo. **NOTA:** Recuerde que si esta bandera no esta presente en el comando se eliminaran las tablas de la BD y se cargaran nuevos datos de ejemplo en ellas, con lo cual despues de la instalacion es recomendable que esta badera este siempre presente. 




## Construido con 🛠️

_Paquetes usados_

- illuminate/database - *Paquete para el manejo de base de datos con Eloquent.*
- fzaninotto/faker - *Paquete para la generacion de datos aleatorios para cargar datos de ejemplo en la BD.*
- doctrine/dbal - *Paquete requerido por illuminate/database*
- illuminate/routing - *Paquete para el manejo de rutas.*
- illuminate/support - *Paquete con funcionalidades generales de Laravel como manejo de cadenas, arreglos, ect. es requerido por varios paquetes de illuminate usados.*
- illuminate/container - *Paquete para usar el contenedor de servicios de Laravel  y la inyeccion de dependencias*
- illuminate/events - *Paquete para manejo de eventos requerido por illuminate/routing*
- illuminate/filesystem - *Paquete para el manejo del sistema de archivos requerido por illuminate/validation*
- illuminate/translation - *Paquete para las traducciones requerido por illuminate/validation*
- illuminate/validation - *Paquete para crear reglas de validacion*
- jenssegers/blade - *Paquete para usar blade como sistema de plantillas*
- dmitrymomot/php-session - *Paquete para manejar las sesiones*
- vlucas/phpdotenv - *Paquete para manejar las variables de entorno*

## Autor ✒️

* **John Fredy Velasco Bareño** - *Trabajo Inicial* - [jovel882@gmail.com](mailto:jovel882@gmail.com)


------------------------