FROM php:7.2-cli

RUN apt-get update && apt-get install -y librabbitmq-dev libssh-dev

RUN docker-php-ext-install sockets pdo pdo_mysql

RUN pecl install amqp && docker-php-ext-enable amqp

WORKDIR /opt/demo

ENTRYPOINT ["php", "./bin/console", "server:run", "0.0.0.0:80"]
