#!/usr/bin/env bash

# ni se za poganjat, ampak sluzi kot zapisek zaenkrat

# aplikacija se ob namestitvi da v direktorij /var/www/html/ep, ki je korenski direktorij projekta

sudo a2enmod rewrite
sudo a2enmod ssl

sudo pear install Mail-1.4.1
sudo pear install Net_SMTP-1.8.0
sudo pear install Mail_Mime-1.10.2

sudo chmod 777 logs
sudo chmod 777 data/images

sudo nano /etc/apache2/sites-available/000-default.conf :

<VirtualHost *:80>

	ServerAdmin webmaster@localhost
	DocumentRoot /var/www/html

	ErrorLog ${APACHE_LOG_DIR}/error.log

	<Directory /var/www/html/ep>
		Require all granted
		AllowOverride all
	</Directory>

</VirtualHost>

sudo nano /etc/apache2/sites-available/default-ssl.conf :

<IfModule mod_ssl.c>
	<VirtualHost _default_:443>
		ServerAdmin webmaster@localhost

		DocumentRoot /var/www/html

		ErrorLog ${APACHE_LOG_DIR}/error.log
		CustomLog ${APACHE_LOG_DIR}/access.log combined

		SSLEngine on

		SSLCertificateFile /var/www/html/ep/certs/streznik/localhost-cert.pem
		SSLCertificateKeyFile /var/www/html/ep/certs/streznik/localhost-key.pem
		SSLCACertificateFile /var/www/html/ep/certs/agencija/ep_vaje_2017-cacert.pem
		SSLCARevocationFile /var/www/html/ep/certs/agencija/ep_vaje_2017-crl.pem

		SSLCARevocationCheck chain

		<Directory /var/www/html/ep>
			Require all granted
			AllowOverride all
		</Directory>

		<FilesMatch "\.(cgi|shtml|phtml|php)$">
            SSLOptions +StdEnvVars
		</FilesMatch>
		<Directory /usr/lib/cgi-bin>
            SSLOptions +StdEnvVars
		</Directory>

		<LocationMatch "ep/index.php/osebje/prijava">
			SSLVerifyClient require
            SSLVerifyDepth 1
            SSLOptions +ExportCertData
        </LocationMatch>

	</VirtualHost>
</IfModule>

sudo nano /etc/php/7.0/apache2/php.ini :
# odkomentiraj:
include_path = ".:/usr/share/php"


sudo service apache2 restart
