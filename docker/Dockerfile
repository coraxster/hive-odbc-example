FROM php:7.0.30-fpm-jessie
RUN apt-get update

RUN apt-get install -y cmake unixodbc unixodbc-dev rpm

RUN set -ex; \
	    docker-php-source extract; \
	    { \
	        echo '# https://github.com/docker-library/php/issues/103#issuecomment-271413933'; \
	        echo 'AC_DEFUN([PHP_ALWAYS_SHARED],[])dnl'; \
	        echo; \
	        cat /usr/src/php/ext/odbc/config.m4; \
	    } > temp.m4; \
	    mv temp.m4 /usr/src/php/ext/odbc/config.m4; \
	    docker-php-ext-configure odbc --with-unixODBC=shared,/usr; \
	    docker-php-ext-install odbc; \
	    docker-php-source delete \
	&& docker-php-ext-configure pdo_odbc --with-pdo-odbc=unixODBC,/usr \
	&& docker-php-ext-install pdo_odbc

ADD clouderahiveodbc_2.5.25.1020-2_amd64.deb /
RUN dpkg -i /clouderahiveodbc_2.5.25.1020-2_amd64.deb

ADD odbc.ini /opt/cloudera/hiveodbc/Setup
ADD cloudera.hiveodbc.ini /opt/cloudera/hiveodbc/lib/64

ENV ODBCSYSINI=/opt/cloudera/hiveodbc/Setup
ENV ODBCINI=/opt/cloudera/hiveodbc/Setup/odbc.ini
ENV SIMBAINI=/opt/cloudera/hiveodbc/lib/64/cloudera.hiveodbc.ini
