FROM php:7.3-apache

# fallback index.php
RUN echo '<Directory "/var/www/html/app">' >> /etc/apache2/apache2.conf
RUN echo 'FallbackResource /index.php' >> /etc/apache2/apache2.conf
RUN echo '</Directory>' >> /etc/apache2/apache2.conf


# block access
RUN echo '<Files ~ "\.php$">' >> /etc/apache2/apache2.conf
RUN echo 'Order allow,deny' >> /etc/apache2/apache2.conf
RUN echo 'Deny from all' >> /etc/apache2/apache2.conf
RUN echo '</Files>' >> /etc/apache2/apache2.conf

RUN echo '<Files ~ "\.ini$">' >> /etc/apache2/apache2.conf
RUN echo 'Order allow,deny' >> /etc/apache2/apache2.conf
RUN echo 'Deny from all' >> /etc/apache2/apache2.conf
RUN echo '</Files>' >> /etc/apache2/apache2.conf

RUN echo '<Files ~ "\.json$">' >> /etc/apache2/apache2.conf
RUN echo 'Order allow,deny' >> /etc/apache2/apache2.conf
RUN echo 'Deny from all' >> /etc/apache2/apache2.conf
RUN echo '</Files>' >> /etc/apache2/apache2.conf

# allow access
RUN echo '<Files "index.php">' >> /etc/apache2/apache2.conf
RUN echo 'allow from all' >> /etc/apache2/apache2.conf
RUN echo '</Files>' >> /etc/apache2/apache2.conf

# redirect access
RUN echo 'ErrorDocument 403 /index.php' >> /etc/apache2/apache2.conf



ENV APACHE_DOCUMENT_ROOT /var/www/html/app

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
#RUN sed -ri -e 's!\b/var/www/\b!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


#install composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#
#COPY ./composer.json /var/www/html/
#
##base extensions
#RUN apt-get update
#RUN apt-get install -y libzip-dev
#RUN docker-php-ext-install zip
#
#RUN composer update
#RUN composer install

COPY . /var/www/html/app

