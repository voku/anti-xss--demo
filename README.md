Anti-XSS Demo (Slim 4 + Twig 3 + AntiXSS)
=========================================

This is the demo application for the Anti-XSS package, refreshed for a modern 2026-ready stack.

* **Controller / Routing**: Slim 4
* **Model / Persistence**: ActiveRecord via `voku/simple-active-record`
* **View / Template**: Twig 3
* **Security**: `voku/anti-xss`
* **Frontend**: Bootstrap 5 + Sass + npm scripts

## Requirements

* PHP 8.2+
* Composer 2.8+
* Node.js 20+
* A MySQL-compatible database

## Installation

The instructions below assume an Apache + PHP setup on Ubuntu or another apt-based distribution.

```bash
sudo a2enmod rewrite
sudo service apache2 restart
```

Clone the repository and install the dependencies:

```bash
cd /var/www
git clone https://github.com/voku/anti-xss-demo anti-xss-demo
cd anti-xss-demo
composer install
cd web
npm install
npm run build
```

Point your web root at the `web/` directory:

```apache
<VirtualHost *:80>
    DocumentRoot /var/www/anti-xss-demo/web
    ServerName anti-xss-demo.example.com
</VirtualHost>
```

Allow `.htaccess` overrides in your Apache config:

```apache
<Directory "/var/www">
    AllowOverride All
</Directory>
```

## Configuration

Database settings are loaded from the following environment variables and fall back to local defaults when omitted:

* `DB_HOST`
* `DB_NAME`
* `DB_USER`
* `DB_PASS`
* `APP_ENV` (`production` disables Slim debug mode)

Database example:

```sql
CREATE TABLE `xss` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `xss` TEXT NOT NULL,
    `desc` TEXT NOT NULL,
    `keywords` VARCHAR(50) NULL DEFAULT '',
    `author` VARCHAR(50) NULL DEFAULT '',
    `date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;
```

## Project structure

* `app/` contains the application bootstrap, config, routes, models, Twig extension, and templates
* `web/` contains the public entrypoint plus built CSS/JS assets
* `web/scss/` and `web/js/` contain the editable frontend sources

## Build frontend assets

```bash
cd /var/www/anti-xss-demo/web
npm run build
```

## License

Software licensed under the [MIT license](https://opensource.org/licenses/MIT).
