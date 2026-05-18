# Gunakan dasar PHP + Apache
FROM php:8.2-apache

# Install ekstensi MySQL untuk PHP dan install MySQL Server secara lokal di dalam container
RUN apt-get update && apt-get install -y \
    mysql-server \
    && docker-php-ext-install mysqli pdo pdo_mysql

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Copy semua file proyek ke folder Apache
COPY . /var/www/html/

# Jalankan skrip otomatis untuk menyalakan MySQL, import database .sql, dan nyalakan Apache
RUN echo '#!/bin/bash\n\
service mysql start\n\
mysql -e "CREATE DATABASE IF NOT EXISTS spk_prioritas_tugas;"\n\
mysql -e "ALTER USER \x27root\x27@\x27localhost\x27 IDENTIFIED WITH mysql_native_password BY \x27suki\x27;"\n\
mysql -e "FLUSH PRIVILEGES;"\n\
if [ -f /var/www/html/spk_prioritas_tugas.sql ]; then\n\
    mysql spk_prioritas_tugas < /var/www/html/spk_prioritas_tugas.sql\n\
fi\n\
apache2-foreground' > /usr/local/bin/start.sh && chmod +x /usr/local/bin/start.sh

# Jalankan skrip saat container dinyalakan
CMD ["/usr/local/bin/start.sh"]