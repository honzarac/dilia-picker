ARG ALPINE_VERSION=3.16
FROM alpine:${ALPINE_VERSION}

# Setup document root
WORKDIR /var/www/html

# Install packages and remove default server definition
RUN apk add --no-cache \
  curl \
  nginx \
  php8 \
  php8-ctype \
  php8-tokenizer \
  php8-curl \
  php8-dom \
  php8-fpm \
  php8-gd \
  php8-intl \
  php8-mbstring \
  php8-mysqli \
  php8-opcache \
  php8-openssl \
  php8-phar \
  php8-session \
  php8-xml \
  php8-xmlreader \
  supervisor

RUN apk add php8-pecl-couchbase

# Create symlink so programs depending on `php` still function
#RUN ln -s /usr/bin/php8 /usr/bin/php

# Configure nginx
COPY ops/docker/app/config/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY ops/docker/app/config/fpm-pool.conf /etc/php8/php-fpm.d/www.conf
COPY ops/docker/app/config/php.ini /etc/php8/conf.d/custom.ini

# Configure supervisord
COPY ops/docker/app/config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R nginx /var/www/html /run /var/lib/nginx /var/log/nginx

# Switch to use a non-root user from here on
USER nginx

# Add application
COPY --chown=nginx . /var/www/html/

# Expose the port nginx is reachable on
EXPOSE 80

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:80/fpm-ping