FROM php:8.3.2-apache

RUN a2enmod rewrite
RUN apt-get -y update
RUN apt-get -y install git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer