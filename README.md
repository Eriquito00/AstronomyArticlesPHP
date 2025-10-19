# AstronomyArticlesPHP 🌌

**AstronomyArticlesPHP** es una aplicación web desarrollada en PHP que permite obtener, almacenar y visualizar artículos cortos sobre astronomía desde la API REST de Wikipedia. La aplicación recupera automáticamente información de artículos astronómicos (con imágenes incluidas), los guarda en una base de datos MySQL y los presenta con paginación para una navegación fácil y organizada.

## 📋 Descripción

Este proyecto es una aplicación web interactiva que:
- 🔍 Obtiene artículos de astronomía desde la API REST de Wikipedia en español
- 💾 Almacena los artículos en una base de datos MySQL usando PDO
- 📄 Presenta los artículos con paginación configurable (2, 5 o 10 artículos por página)
- 🎨 Ofrece una interfaz web limpia y fácil de usar
- 📝 Permite configurar qué artículos buscar mediante un archivo CSV
- 🔄 Incluye funcionalidad para recargar artículos bajo demanda

La aplicación utiliza el patrón MVC (Modelo-Vista-Controlador) y sigue las mejores prácticas de desarrollo PHP, incluyendo el uso de PDO para evitar inyecciones SQL.

## 🚀 Cómo Ejecutar el Proyecto

### Requisitos Previos

- **XAMPP** (incluye Apache, MySQL y PHP)
- **Git** (para clonar el repositorio)

### Instalación de XAMPP

**XAMPP** es requerido para ejecutar esta aplicación PHP localmente con Apache y MySQL.

#### Paso 1: Instalar XAMPP
1. Descarga XAMPP desde el sitio web oficial: [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. Ejecuta el instalador y sigue el asistente de instalación
3. Instala XAMPP en la ubicación predeterminada:
   - Windows: `C:\xampp`
   - Linux: `/opt/lampp`
   - macOS: `/Applications/XAMPP`
4. Durante la instalación, asegúrate de seleccionar al menos los módulos:
   - ✅ **Apache** (servidor web)
   - ✅ **MySQL** (base de datos)
   - ✅ **PHP** (lenguaje de programación)
   - ✅ **phpMyAdmin** (administrador de base de datos)

#### Paso 2: Clonar el Repositorio

1. Navega a tu directorio de instalación de XAMPP segun tu SO.

2. **Opcional pero Recomendado**: Crea una carpeta XamppOriginal para introducir dentro todos los archivos de la web original de XAMPP:
   ```bash
   htdocs/
   └── XamppOriginal/ (Archivos originales de XAMPP)
   ```

3. Clona este repositorio:
   ```bash
   git clone https://github.com/Eriquito00/AstronomyArticlesPHP.git
   ```

   La estructura resultante debería ser:
   ```
   htdocs/
   ├── AstronomyArticlesPHP/  (Este proyecto)
   └── XamppOriginal/         (Archivos originales de XAMPP - opcional)
   ```

#### Paso 3: Configurar y Iniciar los Servicios de XAMPP

1. **Abrir el Panel de Control de XAMPP**

2. **Iniciar los servicios necesarios**
   - Haz clic en el botón **"Start"** junto a **Apache**
   - Haz clic en el botón **"Start"** junto a **MySQL**
   - Verifica que ambos servicios muestren el estado **"Running"**

3. **Verificar que los servicios funcionan correctamente**
   - Apache debería estar ejecutándose en el puerto **80** (o **8080** si el 80 está ocupado)
   - MySQL debería estar ejecutándose en el puerto **3306**
   - Si algún puerto está ocupado, puedes cambiarlo desde la configuración del Panel de Control

#### Paso 4: Acceder a la Aplicación

1. Abre tu navegador web favorito (Chrome, Firefox, Edge, Safari, etc.)

2. Accede a la aplicación mediante una de estas URLs:
   ```
   http://localhost/AstronomyArticlesPHP/public
   ```
   O si el puerto 80 está ocupado y Apache está en el puerto 8080:
   ```
   http://localhost:8080/AstronomyArticlesPHP/public
   ```

3. **¡Listo!** La aplicación se iniciará automáticamente:
   - La base de datos `articles_db` se creará automáticamente si no existe
   - Los artículos del CSV se cargarán automáticamente en la primera ejecución
   - Verás una página con artículos de astronomía provenientes de Wikipedia

### Configuración de la Base de Datos (Opcional)

El proyecto está configurado por defecto para:
- **Host:** `localhost`
- **Usuario:** `root`
- **Contraseña:** (vacía por defecto en XAMPP)
- **Base de datos:** `articles_db` (se crea automáticamente)

Si necesitas cambiar estos valores, edita el archivo `/app/models/connection/connectionDB.php`:

```php
$tempCon = new PDO("mysql:host=localhost;charset=utf8", "root", "");
// Cambiar "root" y "" si tu configuración es diferente
```

## 🎯 Uso de la Aplicación

### Interfaz Principal

Una vez que accedas a la aplicación, verás:

1. **Título de la página**: Se muestra en la parte superior (obtenido de la primera línea del CSV)
2. **Lista de artículos**: Cada artículo incluye:
   - 📷 Imagen representativa (si está disponible en Wikipedia)
   - 📝 Título del artículo
   - 📄 Extracto o resumen del contenido
3. **Botón "Recargar artículos"**: Recarga toda la información empezando por analizar si hay nuevos artículos en el CSV, yendo a la API de Wikipedia para obtener la información e introduciendo los nuevos artículos a la base de datos.
4. **Selector de paginación**: Permite elegir cuántos artículos mostrar por página (2, 5 o 10)
5. **Navegación de páginas**: Botones de paginación para navegar entre páginas de artículos

### Configuración del Archivo CSV

El archivo `app/resources/titleArticles.csv` controla qué artículos se buscan en Wikipedia. Su formato es muy simple:

#### Estructura del CSV

```csv
Astronomy Articles
Sol
Mercurio (planeta)
Venus (planeta)
Tierra (planeta)
...
```

**Reglas importantes:**
1. ✅ **Primera línea**: Es el **título de la página web**. Este título aparecerá en:
   - El encabezado de la página (etiqueta `<h1>`)
   - El título de la pestaña del navegador (etiqueta `<title>`)

2. ✅ **Líneas restantes**: Cada línea es el **título exacto de un artículo de Wikipedia** que quieres buscar

3. ✅ **Formato**: Archivo de texto plano, una entrada por línea, sin comillas ni delimitadores especiales

#### Ejemplo de Configuración

Si quieres crear una página sobre "Planetas del Sistema Solar":

```csv
Planetas del Sistema Solar
Mercurio (planeta)
Venus (planeta)
Tierra
Marte (planeta)
Júpiter (planeta)
Saturno (planeta)
Urano (planeta)
Neptuno (planeta)
```

#### Cómo Modificar el CSV

1. Abre el archivo `app/resources/titleArticles.csv` con un editor de texto
2. Modifica la primera línea con el título que desees para tu página
3. Añade, elimina o modifica los títulos de artículos (una línea por artículo)
4. Guarda el archivo
5. En la aplicación, haz clic en "Recargar artículos" para aplicar los cambios

#### Consejos para Mejores Resultados

- 📌 Usa los títulos exactos que aparecen en Wikipedia. Por ejemplo, para los nombres de planetas, añade "(planeta)" al final: `Marte (planeta)`. Para lenguajes de programación, añade "(lenguaje de programación)" al final: `Java (lenguaje de programación)`. Aunque no siempre es necesario, es mejor consultar el nombre en Wikipedia y añadirlo al CSV con ese título.
- 📌 Evita términos ambiguos que puedan tener múltiples significados
- 📌 Si un artículo no se encuentra, aparecerá un mensaje de error en la página

## 📁 Estructura del Proyecto

```
AstronomyArticlesPHP/
│
├── .htaccess                      # Configuración de Apache (redirección a public/)
├── LICENSE                        # Licencia MIT del proyecto
├── README.md                      # Este archivo
│
├── app/                          # Directorio principal de la aplicación
│   │
│   ├── controllers/              # Controladores (lógica de negocio)
│   │   └── controller.php        # Controlador principal que maneja las peticiones
│   │
│   ├── models/                   # Modelos (capa de datos)
│   │   ├── classes/              # Clases de dominio
│   │   │   └── article.php       # Clase Article (representa un artículo)
│   │   │
│   │   ├── connection/           # Gestión de conexión a base de datos
│   │   │   └── connectionDB.php  # Conexión PDO y funciones de BD
│   │   │
│   │   ├── dao/                  # Data Access Objects (patrón DAO)
│   │   │   ├── interfaces/       # Interfaces DAO
│   │   │   │   └── articleDAO.php
│   │   │   │
│   │   │   └── daofunctions/     # Implementaciones DAO
│   │   │       └── articleDAOFunc.php
│   │   │
│   │   └── data/                 # Gestión de datos externos
│   │       └── csvData.php       # Funciones para leer el CSV
│   │
│   ├── views/                    # Vistas (presentación)
│   │   ├── page.php              # Plantilla principal de la página
│   │   └── articles.php          # Vista de listado de artículos
│   │
│   ├── services/                 # Servicios externos
│   │   └── wikipediaAPIClient.php # Cliente para consumir la API de Wikipedia
│   │
│   ├── resources/                # Recursos estáticos
│   │   └── titleArticles.csv     # Archivo CSV con los títulos de artículos
│   │
│   └── database/                 # Scripts de base de datos
│       └── schema.sql            # Schema de la base de datos
│
└── public/                       # Directorio público (punto de entrada)
    ├── index.php                 # Punto de entrada de la aplicación
    │
    ├── styles/                   # Hojas de estilo CSS
    │   └── style.css             # Estilos principales
    │
    └── assets/                   # Recursos estáticos (imágenes, iconos)
        └── favicon.svg           # Icono de la aplicación
```

## 📄 Licencia

Este proyecto está bajo la Licencia MIT - consulta el archivo [LICENSE](LICENSE) para más detalles.

### ¿Qué significa la Licencia MIT?

La Licencia MIT es una licencia de software permisiva que permite:

- ✅ Uso comercial
- ✅ Modificación
- ✅ Distribución
- ✅ Uso privado

**Condiciones:**
- 📋 Debes incluir el aviso de copyright y la licencia en todas las copias
- ⚠️ El software se proporciona "tal cual", sin garantías de ningún tipo

## 🤝 Contribuciones

¡Las contribuciones son bienvenidas! Este proyecto está abierto a mejoras y nuevas funcionalidades.

⭐ Si te gusta este proyecto, ¡dale una estrella en GitHub!

**Hecho con ❤️ y PHP**
