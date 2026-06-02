FROM richarvey/nginx-php-fpm:latest

# Копируем весь код проекта в контейнер
COPY . /var/www/html

# Настраиваем конфигурацию для Laravel
ENV WEBROOT /var/www/html/public
ENV APP_ENV production

# Выполняем установку зависимостей через Composer
RUN composer install --no-dev --optimize-autoloader

# Даем права серверу на папки кэша и хранилища
RUN chown -R nw-data:nginx-data /var/www/html/storage /var/www/html/bootstrap/cache