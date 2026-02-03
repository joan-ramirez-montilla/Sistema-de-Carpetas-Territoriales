# Sistema de Carpetas Territoriales

Una aplicación Laravel moderna para la gestión y administración de carpetas territoriales, distritos, municipios, provincias y organizaciones. Construida con Livewire, Tailwind CSS y Docker.

## 🚀 Características Principales

- **Gestión de Territorios**: Administra provincias, municipios, distritos y regiones
- **Gestión de Organizaciones**: Crea y mantén organizaciones con estructuras jerárquicas
- **Gestión de Personas**: Registra y gestiona personas con cargos y horarios
- **Importación de Datos**: Importa masivamente datos desde archivos Excel
- **Componentes Interactivos**: Interfaz dinámica con Livewire
- **Autenticación**: Sistema de autenticación completo con Laravel Fortify
- **Responsive Design**: Diseño responsivo con Tailwind CSS
- **Multi-tenancy**: Soporte para múltiples tenants con Stancl Tenancy

## 📋 Requisitos Previos

- PHP 8.2 o superior
- Docker y Docker Compose
- Node.js 16+ (para compilación de assets)
- Composer

## 🛠️ Instalación

### Con Docker (Recomendado)

```bash
# Clonar el repositorio
git clone <repository-url>
cd Sistema-de-Carpetas-Territoriales

# Instalar dependencias PHP
composer install

# Instalar dependencias Node
npm install

# Copiar archivo de entorno
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

# Construir y levantar contenedores
docker-compose up -d

# Ejecutar migraciones
docker-compose exec app php artisan migrate

# (Opcional) Ejecutar seeders
docker-compose exec app php artisan db:seed
```

### Sin Docker

```bash
# Instalar dependencias
composer install
npm install

# Copiar y configurar .env
cp .env.example .env

# Generar clave
php artisan key:generate

# Crear base de datos y ejecutar migraciones
php artisan migrate

# Compilar assets
npm run build

# Iniciar servidor
php artisan serve
```

## 📁 Estructura del Proyecto

```
app/
├── Console/          # Comandos artisan
├── Http/             # Controllers y Middleware
├── Imports/          # Importadores de datos (Excel)
├── Livewire/         # Componentes Livewire
│   ├── Districts/
│   ├── Municipalities/
│   ├── Organizations/
│   ├── People/
│   ├── Positions/
│   ├── Provinces/
│   ├── Regions/
│   └── Settings/
├── Models/           # Modelos Eloquent
├── Traits/           # Traits reutilizables
└── Concerns/         # Concerns compartidas

database/
├── migrations/       # Migraciones de base de datos
├── seeders/          # Seeders para datos de prueba
└── factories/        # Factories para testing

resources/
├── views/           # Vistas Blade
├── css/             # Estilos Tailwind
└── js/              # JavaScript

tests/
├── Feature/         # Tests de funcionalidad
└── Unit/            # Tests unitarios
```

## 🔧 Modelos Principales

- **Region**: Regiones administrativas
- **Province**: Provincias
- **District**: Distritos
- **Municipality**: Municipios
- **Organization**: Organizaciones
- **Person**: Personas
- **Position**: Cargos/Posiciones
- **User**: Usuarios del sistema
- **Constituency**: Circunscripciones electorales

## 🚀 Desarrollo

### Compilar Assets

```bash
# Desarrollo con hot reload
npm run dev

# Producción
npm run build
```

### Ejecutar Tests

```bash
./vendor/bin/phpunit
```

### Code Style

```bash
# Formatear código con Pint
php artisan pint
```

### Importar Datos

El sistema incluye importadores para datos en Excel:

```php
// Importar personas desde Excel
php artisan import:people archivo.xlsx
```

## 📦 Dependencias Principales

- **Laravel 12**: Framework PHP principal
- **Livewire 4**: Componentes interactivos sin JavaScript
- **Flux**: Componente UI library para Livewire
- **Tailwind CSS 4**: Framework de estilos
- **Laravel Fortify**: Autenticación y verificación
- **Stancl Tenancy**: Soporte multi-tenant
- **Maatwebsite Excel**: Importación/exportación Excel
- **DomPDF**: Generación de PDFs
- **Laravel Tinker**: CLI interactivo para Laravel

## 🐳 Servicios Docker

El proyecto incluye los siguientes servicios:

- **app**: Contenedor PHP con la aplicación
- **web**: Servidor Nginx (puerto 8000)
- **db**: Base de datos MySQL 8.0

### Comandos Útiles

```bash
# Ver logs de la aplicación
docker-compose logs -f app

# Ejecutar comandos en el contenedor
docker-compose exec app php artisan <comando>

# Parar contenedores
docker-compose down

# Reconstruir contenedores
docker-compose up -d --build
```

## 📚 Recursos Adicionales

- [Documentación de Laravel](https://laravel.com/docs)
- [Documentación de Livewire](https://livewire.laravel.com)
- [Documentación de Tailwind CSS](https://tailwindcss.com/docs)
- [Documentación de Laravel Fortify](https://laravel.com/docs/fortify)

## 📝 Variables de Entorno

Copia `.env.example` a `.env` y ajusta según tus necesidades:

```env
APP_NAME="Sistema de Carpetas Territoriales"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=territorial_system
DB_USERNAME=root
DB_PASSWORD=root
```

## 🤝 Contribución

Las contribuciones son bienvenidas. Por favor:

1. Fork el repositorio
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la licencia MIT. Ver [LICENSE](LICENSE) para más detalles.

## 📞 Soporte

Para soporte o reportar problemas, abre un issue en el repositorio.
