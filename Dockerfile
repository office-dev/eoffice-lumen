ARG PHP_VERSION=8.0
ARG CADDY_VERSION=2

FROM php:${PHP_VERSION}-fpm-alpine as eoffice_php

ARG WWWGROUP

# persistent / runtime deps
RUN apk add --no-cache \
		acl \
		fcgi \
		file \
		gettext \
		git \
		gnu-libiconv \
	;

# install gnu-libiconv and set LD_PRELOAD env to make iconv work fully on Alpine image.
# see https://github.com/docker-library/php/issues/240#issuecomment-763112749
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so

ARG APCU_VERSION=5.1.19
RUN set -eux; \
	apk add --no-cache --virtual .build-deps \
		$PHPIZE_DEPS \
		icu-dev \
		libzip-dev \
		postgresql-dev \
		zlib-dev \
	; \
	\
	docker-php-ext-configure zip; \
	docker-php-ext-install -j$(nproc) \
		intl \
		pdo_pgsql \
		zip \
	; \
	pecl install \
		apcu-${APCU_VERSION} \
        xdebug \
	; \
	pecl clear-cache; \
	docker-php-ext-enable \
		apcu \
		opcache \
        xdebug \
	; \
	\
	runDeps="$( \
		scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
			| tr ',' '\n' \
			| sort -u \
			| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
	)"; \
	apk add --no-cache --virtual .api-phpexts-rundeps $runDeps; \
	\
	apk del .build-deps

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN ln -s $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini
COPY docker/php/conf.d/eoffice.prod.ini $PHP_INI_DIR/conf.d/eoffice.ini
COPY docker/php/php-fpm.d/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

VOLUME /var/run/php
# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

VOLUME /srv/api/storage
WORKDIR /srv/api

# build for production
ARG APP_ENV=prod

COPY docker/php/docker-healthcheck.sh /usr/local/bin/docker-healthcheck
RUN chmod +x /usr/local/bin/docker-healthcheck

HEALTHCHECK --interval=10s --timeout=3s --retries=3 CMD ["docker-healthcheck"]

COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

FROM caddy:${CADDY_VERSION}-builder-alpine AS eoffice_caddy_builder

# install Mercure and Vulcain modules
RUN xcaddy build \
    --with github.com/dunglas/mercure \
    --with github.com/dunglas/mercure/caddy \
    --with github.com/dunglas/vulcain \
    --with github.com/dunglas/vulcain/caddy

FROM caddy:${CADDY_VERSION} AS eoffice_caddy

WORKDIR /srv/api

COPY --from=eoffice_caddy_builder /usr/bin/caddy /usr/bin/caddy
#COPY --from=eoffice_php /srv/api/public public/
COPY docker/caddy/Caddyfile /etc/caddy/Caddyfile

