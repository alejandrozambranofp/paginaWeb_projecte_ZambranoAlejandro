# Docker Sweet Kingdom

Este proyecto se puede levantar con Docker usando tres servicios:

- `web`: servidor PHP con Apache.
- `db`: base de datos MySQL.
- `phpmyadmin`: panel para revisar la base de datos.

## Comandos

Construir y arrancar los contenedores:

```bash
docker compose up -d --build
```

Abrir la web:

```text
http://localhost:8080
```

Abrir phpMyAdmin:

```text
http://localhost:8081
```

Datos de phpMyAdmin:

```text
Servidor: db
Usuario: sweet_user
Contrasena: sweet_pass
Base de datos: sweet_kingdom
```

Parar los contenedores:

```bash
docker compose down
```

Borrar tambien los datos de MySQL para volver a importar el SQL desde cero:

```bash
docker compose down -v
```

## Explicacion

`docker-compose.yml` define los contenedores. El contenedor `web` usa PHP y Apache para ejecutar la aplicacion. El contenedor `db` usa MySQL y carga el archivo `database/sweet_kingdom.sql` la primera vez que se crea la base de datos. El contenedor `phpmyadmin` sirve para ver las tablas desde el navegador.

La conexion de PHP usa variables de entorno (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASSWORD`). Si esas variables no existen, el proyecto usa los datos de XAMPP por defecto.