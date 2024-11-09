# README - Proyecto de Enseñanza en Línea

Este proyecto tiene como objetivo administrar un pequeño sitio web de enseñanza en línea con dos roles principales: Administrador y Usuario. El sistema permite a los administradores gestionar cursos, videos, y usuarios, mientras que los usuarios pueden registrarse en cursos, ver videos, dejar comentarios y seguir su progreso.

### Requisitos

-   PHP 8.x o superior
-   Composer
-   Node.js y npm
-   MySQL o base de datos compatible
-   Laravel 10.x o superior

## Pasos para ejecutar el proyecto

1. **Clonar el repositorio**

    Clona el repositorio en tu máquina local.

    ```bash
    git clone https://github.com/pintoderian/video-courses.git
    cd video-courses
    ```

2. **Crear el archivo `.env`**

    Crea un archivo `.env` a partir del archivo `.env.example` para configurar las variables de entorno.

    ```bash
    cp .env.example .env
    ```

3. **Instalar dependencias**

    Instala las dependencias de PHP y de JavaScript.

    ```bash
    composer install
    npm install
    ```

4. **Configurar la base de datos**

    Asegúrate de tener una base de datos configurada en el archivo `.env` con los siguientes parámetros:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_base_de_datos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```

5. **Ejecutar migraciones**

    Ejecuta las migraciones para crear las tablas en la base de datos.

    ```bash
    php artisan migrate
    ```

6. **Ejecutar el seeder para agregar datos de prueba**

    Si deseas agregar datos de prueba, ejecuta el siguiente comando:

    ```bash
    php artisan db:seed
    ```

7. **Compilar los assets**

    Para la compilación de los archivos estáticos (CSS, JS, etc.), ejecuta:

    ```bash
    npm run build
    ```

8. **Iniciar el servidor de desarrollo**

    Una vez configurado todo, inicia el servidor de desarrollo de Laravel:

    ```bash
    php artisan serve
    ```

    El sitio web estará disponible en `http://localhost:8000`.

## Datos de prueba

### Admin

```
email: me@dpinto.dev
password: password123
```

### User

```
email: testuser@dpinto.dev
password: password123
```

## Funcionalidades del Proyecto

### Roles

-   **Administrador**:

    -   Puede crear y gestionar cursos y videos.
    -   Puede administrar categorías de cursos y videos.
    -   Puede ver los comentarios hechos por los usuarios y aprobarlos o rechazarlos.
    -   Puede ver las estadísticas de progreso de los usuarios y su actividad en los cursos.

-   **Usuario**:
    -   Puede registrarse en el sitio.
    -   Puede buscar y registrarse en cursos.
    -   Puede ver los videos de los cursos en los que está registrado.
    -   Puede dejar comentarios y dar likes a los videos.
    -   Puede ver su progreso en los cursos en los que está inscrito.

### Características de la Web

1. **Gestión de Cursos y Videos (Administrador)**:

    - Los administradores pueden crear cursos con:
        - Nombre, descripción, categoría y grupos de edades.
        - Los cursos pueden tener videos de YouTube.
    - Los administradores pueden gestionar los videos de cada curso:
        - Los videos pueden ser etiquetados con categorías.
        - Los videos pueden ser marcados como bloqueados o visibles.

2. **Registro de Usuarios y Progreso de Cursos**:

    - Los usuarios pueden registrarse en un curso.
    - Los usuarios pueden ver videos del curso y dejar comentarios.
    - Los usuarios pueden dar likes a los videos.
    - Los usuarios pueden ver su progreso de visualización de los videos.

3. **Administración de Usuarios y Progreso (Administrador)**:

    - Los administradores pueden ver todos los usuarios registrados en los cursos y el progreso de estos.
    - Los administradores pueden ver en qué video está cada usuario.

4. **Gestión de Comentarios (Administrador)**:
    - Los administradores pueden aprobar o rechazar los comentarios dejados por los usuarios en los videos.
    - Los administradores pueden ver los likes y las estadísticas de los videos.

### API de la Aplicación

La API permite la interacción con los datos de cursos, videos, comentarios, likes y progreso.

#### Rutas de la API

1. **Listar todos los cursos**

    `GET /api/v1/courses`

    **Respuesta esperada**:

    ```json
    {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "name": "Course of Music #1",
                "slug": "course-of-music-1",
                "age_group": "9-13",
                "category": {
                    "id": 12,
                    "name": "Music"
                },
                "created_at": "2024-11-09T05:04:19.000000Z"
            }
        ]
    }
    ```

2. **Buscar cursos por categoría, rango de edad y nombre**

    `GET /api/v1/courses?category_id={categoryId}&age_group={ageGroup}&search={name}`

3. **Registrar un usuario en un curso**

    `POST /api/v1/courses/register`

    **Parametros en el cuerpo**:

    ```json
    {
        "user_id": 1,
        "course_id": 1
    }
    ```

4. **Ver videos de un curso**

    `GET /api/v1/courses/{courseId}/videos`

    **Respuesta esperada**:

    ```json
    {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "name": "Video 1 del Course of Photography #1",
                "slug": "video-1-del-course-of-photography-1",
                "course_id": 1,
                "url": "https://www.youtube.com/watch?v=dQw4w9WgXcQ",
                "description": "Description Video Video 1 del Course of Photography #1",
                "is_block": 0
            }
        ]
    }
    ```

5. **Subir comentarios**

    `POST /api/v1/comments/{videoId}`

    **Parametros en el cuerpo**:

    ```json
    {
        "user_id": 1,
        "video_id": 1,
        "comment": "Great video!"
    }
    ```

6. **Dar likes a un video**

    `POST /api/v1/videos/{videoId}/like`

    **Parametros en el cuerpo**:

    ```json
    {
        "user_id": 1
    }
    ```

7. **Actualizar progreso de un video**

    `POST /api/v1/progress/{courseId}/update`

    **Parametros en el cuerpo**:

    ```json
    {
        "user_id": 1,
        "video_id": 1,
        "is_completed": true
    }
    ```

## Pruebas Unitarias

Las pruebas unitarias se han implementado para asegurar que la API y las funcionalidades de la aplicación funcionen correctamente. Puedes ejecutar las pruebas con el siguiente comando:

```bash
php artisan test
```

### Dependencias principales

-   **Laravel**: Framework PHP para el desarrollo web.
-   **Livewire**: Biblioteca para interfaces dinámicas en Laravel.
-   **Laravel Sanctum**: Para la autenticación de la API.
-   **Factory y Seeder**: Para la generación de datos de prueba.

### SCREENS

<img src="/screenshots/screenshot-1.png" width="300">

<img src="/screenshots/screenshot-2.png" width="300">

<img src="/screenshots/screenshot-3.png" width="300">

<img src="/screenshots/screenshot-4.png" width="300">

<img src="/screenshots/screenshot-5.png" width="300">

<img src="/screenshots/screenshot-6-admin.png" width="300">

<img src="/screenshots/screenshot-7.png" width="300">

<img src="/screenshots/screenshot-8.png" width="300">

<img src="/screenshots/screenshot-9.png" width="300">
