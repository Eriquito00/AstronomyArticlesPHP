# AstronomyArticlesPHP
Short astronomy articles from Wikipedia's REST API using PHP, saves to a database, and applies pagination.

## Dependencias

Este proyecto requiere las siguientes dependencias:

### 1. Instalación de XAMPP

**XAMPP** es requerido para ejecutar esta aplicación PHP localmente con Apache y MySQL.

#### Instalando XAMPP:
1. Descarga XAMPP desde el sitio web oficial: [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. Ejecuta el instalador y sigue el asistente de instalación
3. Instala XAMPP en la ubicación predeterminada (generalmente `C:\xampp` en Windows)
4. Durante la instalación, asegúrate de seleccionar al menos los módulos:
   - **Apache** (servidor web)
   - **MySQL** (base de datos)
   - **PHP** (lenguaje de programación)
   - **phpMyAdmin** (administrador de base de datos)

#### Configuración del Proyecto en XAMPP:
1. Navega a tu directorio de instalación de XAMPP `C:\xampp\htdocs` (Windows) o `/opt/lampp/htdocs` (Linux)

2. **Opcional pero Recomendado**: Crea una carpeta `XamppOriginal` para introducir dentro todos los archivos de la web original de XAMPP:
   ```
   htdocs/
   └── XamppOriginal/ (Archivos originales de XAMPP)
   ```

3. Clona este repositorio en la ruta donde XAMPP muestra las webs:
    
    ```bash
    cd C:\xampp\htdocs
    ```

    Luego clona el repositorio:
    ```bash
    git clone https://github.com/Eriquito00/AstronomyArticlesPHP
    ```

   La estructura resultante debería ser:
   ```
   htdocs/
   ├── AstronomyArticlesPHP/  (Este proyecto)
   └── XamppOriginal/      (Archivos originales de XAMPP - opcional)
   ```

## Cómo Ejecutar el Proyecto

### Paso 1: Configurar los Servicios de XAMPP

1. **Abrir el Panel de Control de XAMPP**
2. **Iniciar los servicios necesarios**
   - Haz clic en el botón **"Start"** junto a **Apache**
   - Haz clic en el botón **"Start"** junto a **MySQL**
   - Verifica que ambos servicios muestren el estado "Running"

3. **Verificar que los servicios funcionan correctamente**
   - Apache debería estar ejecutándose en el puerto 80 (o 8080 si el 80 está ocupado)
   - MySQL debería estar ejecutándose en el puerto 3306
   - Si algún puerto está ocupado, puedes cambiarlo desde la configuración del Panel de Control

### Paso 2: Verificar la Configuración de la Base de Datos

El proyecto está configurado para:
- **Host:** localhost
- **Usuario:** root
- **Contraseña:** (vacía por defecto en XAMPP)
- **Base de datos:** articles_db (se crea automáticamente)

Si necesitas cambiar estos valores, edita el archivo `/app/models/connection/connectionDB.php`:

```php
$tempCon = new PDO("mysql:host=localhost;charset=utf8", "root", "");
// Cambiar "root" y "" si tu configuración es diferente
```

## CSV apuntes
La primera linea sera el titulo de la pagina, el resto seran los titulos de los articulos que se iran a buscar a la API REST de Wikipedia.
