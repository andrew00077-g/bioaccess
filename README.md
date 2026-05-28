# BioAccess

Sistema inteligente de control de asistencia académica mediante huella digital utilizando ESP32, sensor biométrico y PHP/MySQL.

---

## Características

- Registro de estudiantes
- Registro de huellas digitales
- Control automático de asistencia
- Detección de:
  - PRESENTE
  - RETRASO
  - NO PRESENTE
- Gestión de materias
- Inscripción de estudiantes por materia
- Generación de reportes PDF
- Interfaz moderna con TailwindCSS
- Comunicación en tiempo real con ESP32

---

## Tecnologías Utilizadas

### Frontend
- HTML5
- TailwindCSS
- JavaScript

### Backend
- PHP
- MySQL

### Hardware
- ESP32
- Sensor de huellas AS608 / R307
- LCD I2C 16x2
- Buzzers

---

## Base de Datos

### Tabla estudiantes

```sql
CREATE TABLE estudiantes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    finger_id INT UNIQUE
);
```

### Tabla materias

```sql
CREATE TABLE materias(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE,
    hora_inicio TIME,
    hora_fin TIME,
    dias VARCHAR(50),
    activa TINYINT(1) DEFAULT 0
);
```

### Tabla inscripciones

```sql
CREATE TABLE inscripciones(
    estudiante_id INT,
    materia_id INT,
    PRIMARY KEY(estudiante_id,materia_id)
);
```

### Tabla asistencia

```sql
CREATE TABLE asistencia(
    id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id INT,
    materia_id INT,
    fecha DATE,
    hora TIME,
    estado VARCHAR(20)
);
```

---

## Funcionamiento

1. El administrador registra estudiantes.
2. Se registra la huella en el sensor biométrico.
3. Se crean materias y horarios.
4. Los estudiantes son inscritos a materias.
5. Se activa una materia desde el sistema.
6. El estudiante coloca su dedo.
7. El ESP32 identifica la huella.
8. PHP registra automáticamente:
   - PRESENTE
   - RETRASO
   - YA MARCÓ
   - NO INSCRITO

---

## Configuración ESP32

Editar:

```cpp
#define WIFI_SSID "TU_WIFI"
#define WIFI_PASSWORD "TU_PASSWORD"

String servidor = "http://TU_IP/sistema_huella/api/";
```

---

## Instalación

### 1. Clonar repositorio

```bash
git clone https://github.com/andrew00077-g/bioaccess.git
```

### 2. Copiar proyecto

Mover la carpeta a:

```txt
xampp/htdocs/
```

### 3. Crear base de datos

Crear:

```txt
bioaccess
```

Importar las tablas SQL.

### 4. Ejecutar XAMPP

Iniciar:
- Apache
- MySQL

### 5. Abrir sistema

```txt
http://localhost/sistema_huella
```

---

## Autor

Andrew Gonzales Butron

---

## Licencia

Proyecto académico.
