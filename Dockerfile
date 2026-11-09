FROM php:8.5-cli

# Instalar dependencias del sistema y herramientas esenciales
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    zip \
    unzip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql mysqli intl

# Instalar Node.js 26 de forma oficial (incluye la versión 26.13.0+)
RUN curl -fsSL https://deb.nodesource.com/setup_26.x | bash - \
    && apt-get install -y nodejs

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo en el contenedor
WORKDIR /app

# Copiar el código del proyecto
COPY . /app

# Instalar dependencias de PHP y compilar assets de Node
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs
RUN npm install && npm run build

# Exponer puerto y configurar el arranque manteniendo las fotos persistentes seguras
EXPOSE 8002
CMD php artisan storage:link && php artisan serve --host=0.0.0.0 --port=8002