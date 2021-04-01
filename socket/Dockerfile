FROM php:7.2-cli

WORKDIR /var/www/html/app

#base extensions
RUN apt-get update
RUN apt-get install -y libzip-dev
RUN docker-php-ext-install zip

#install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./composer.json /var/www/html/

RUN composer update --working-dir=/var/www/html/
RUN composer install --working-dir=/var/www/html/

#copy files
COPY . .

#init server
CMD [ "php", "index.php" ]

#debug
#ENTRYPOINT pwd;ls;echo;ls /var/www/html/
