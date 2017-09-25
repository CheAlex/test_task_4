FROM ubuntu:14.04.1

MAINTAINER Alex Chernoivan <alexsnejinsky@gmail.com>

# Create docker user
RUN mkdir -p /var/www
RUN mkdir -p /home/docker
RUN useradd -d /home/docker -s /bin/bash -M -N -G www-data,sudo,root docker
RUN echo docker:docker | chpasswd
RUN usermod -G www-data,users www-data
RUN chown -R docker:www-data /var/www
RUN chown -R docker:www-data /home/docker

# Base install
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y \
    software-properties-common \
    python-software-properties \
    git \
    vim \
    nano \
    mc \
    screen \
    curl \
    zip \
    unzip \
    wget \
    supervisor \
    htop \
    tmux \
    mcrypt
COPY configs/supervisor/cron.conf /etc/supervisor/conf.d/cron.conf

# PHP
RUN apt-get install -y language-pack-en-base
RUN LC_ALL=en_US.UTF-8 add-apt-repository -y ppa:ondrej/php
RUN apt-get update
RUN apt-get install -y \
    php7.1 \
    php-apcu \
    php-apcu-bc \
    php-imagick \
    php-memcache \
    php-memcached \
    php-pear \
    php-redis \
    php-xdebug \
    php7.1-cgi \
    php7.1-cli \
    php7.1-common \
    php7.1-ctype \
    php7.1-curl \
    php7.1-dev \
    php7.1-fpm \
    php7.1-gd \
    php7.1-imap \
    php7.1-intl \
    php7.1-json \
    php7.1-mbstring \
    php7.1-mysql \
    php7.1-pgsql \
    php7.1-soap \
    php7.1-sqlite3 \
    php7.1-xml \
    php7.1-zip
RUN rm /etc/php/7.1/cgi/php.ini
RUN rm /etc/php/7.1/cli/php.ini
RUN rm /etc/php/7.1/fpm/php.ini
COPY configs/php/php.ini /etc/php/7.1/cgi/php.ini
COPY configs/php/php.ini /etc/php/7.1/cli/php.ini
COPY configs/php/php.ini /etc/php/7.1/fpm/php.ini
COPY configs/php/xdebug.ini /etc/php/7.1/mods-available/xdebug.ini
RUN mkdir /var/log/xdebug
RUN touch /var/log/xdebug/xdebug.log
RUN chown www-data:www-data /var/log/xdebug/xdebug.log
RUN chmod 664 /var/log/xdebug/xdebug.log
RUN sed -i -e 's/listen = \/run\/php\/php7.1-fpm.sock/listen = 0.0.0.0:9000/g' /etc/php/7.1/fpm/pool.d/www.conf \
 && sed -i -e 's/user = www-data/user = docker/g'                              /etc/php/7.1/fpm/pool.d/www.conf \
 && sed -i -e 's/;daemonize = yes/daemonize = no/g'                            /etc/php/7.1/fpm/php-fpm.conf

# Autocomplete Symfony
COPY configs/symfony2and3-autocomplete.bash /etc/bash_completion.d/symfony2and3-autocomplete.bash

# Configs bash start
COPY configs/autostart.sh /root/autostart.sh
RUN  chmod +x /root/autostart.sh
COPY configs/bash.bashrc /etc/bash.bashrc
COPY configs/.bashrc /root/.bashrc
COPY configs/.bashrc /home/docker/.bashrc

# Install locale
RUN locale-gen en_US en_US.UTF-8 uk_UA uk_UA.UTF-8
RUN dpkg-reconfigure locales

## Install Java 8
#RUN apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys EEA14886
#RUN add-apt-repository -y ppa:webupd8team/java
#RUN apt-get update
## accept license non-iteractive
#RUN echo oracle-java8-installer shared/accepted-oracle-license-v1-1 select true | sudo /usr/bin/debconf-set-selections
#RUN apt-get install -y oracle-java8-installer \
#                       oracle-java8-set-default
#RUN echo "JAVA_HOME=/usr/lib/jvm/java-8-oracle" | sudo tee -a /etc/environment
#RUN export JAVA_HOME=/usr/lib/jvm/java-8-oracle

## Install Ant
#RUN sudo apt-get install -y ant

# Install Composer
RUN cd /home
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer
RUN chmod 777 /usr/local/bin/composer

## Install code standarts
#RUN composer global require "squizlabs/php_codesniffer=*"
#RUN composer global require "sebastian/phpcpd=*"
#RUN composer global require "phpmd/phpmd=@stable"
#RUN cd /usr/bin && ln -s ~/.composer/vendor/bin/phpcpd
#RUN cd /usr/bin && ln -s ~/.composer/vendor/bin/phpmd
#RUN cd /usr/bin && ln -s ~/.composer/vendor/bin/phpcs

## Install Gearman
#RUN apt-get -y install libgearman-dev gearman-job-server mod-gearman-tools php-gearman

# For Rabbit MQ
RUN apt-get install php7.1-mbstring php7.1-bcmath php-amqp

## Install zmq
#RUN apt-get install -y libtool pkg-config build-essential autoconf automake libzmq-dev
#RUN pecl install zmq-1.1.3
#RUN touch /etc/php/7.1/mods-available/zmq.ini
#RUN sh -c "echo extension=zmq.so > /etc/php/7.1/mods-available/zmq.ini"
#RUN ln -s /etc/php/7.1/mods-available/zmq.ini /etc/php/7.1/fpm/conf.d/20-zmq.ini
#RUN ln -s /etc/php/7.1/mods-available/zmq.ini /etc/php/7.1/cli/conf.d/20-zmq.ini

# Open ports
# 1) php-fpm handler
EXPOSE 9000

RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#USER docker
