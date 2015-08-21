Anti-XSS (Slim + Twig + Redbean + Anti-XSS)
======================================================

This is a Demo for the Anti-XSS package. 

======================================================

* **Controller/Routing**: Slim ([codeguy/Slim](https://github.com/codeguy/Slim))
* **Model/Persistence/ORM**: RedBean ([gabordemooij/redbean](https://github.com/gabordemooij/redbean))
* **View/Template**: Twig ([fabpot/Twig](https://github.com/fabpot/Twig))
* **Security**: Anti-XSS ([voku/anti-xss](https://github.com/voku/anti-xss))
* **UI Toolkit**: Twitter Bootstrap ([twitter/bootstrap](https://github.com/twitter/bootstrap))


## Installation

The instructions below assume you are running a **LAMP** stack in Ubuntu or any other **apt**-based distributions. To allow Slim to route with clean path syntax, you need to enable the url rewrite module.   

	sudo a2enmod rewrite
	sudo service apache2 restart

Optionally, if you want to run this demo with the default SQLite database, you need the driver

	sudo apt-get install php5-sqlite

Suppose your document root is in /var/www, clone the repository as follows:

	cd /var/www
	git clone https://github.com/voku/anti-xss-demo anti-xss-demo

The required vendor libraries can be installed/updated using [Composer](http://getcomposer.org/). Go to the project root (where you see the file *composer.json*) and run the following command:

	cd ./anti-xss-demo
	composer install

There are some directories should be made writeable to your web server process. 

	chmod -R 777 ./app/storage

Then, update your apache config file to set your document root to the **web** subdirectory. This helps to secure your scripts which should normally be put inside the **app/** folder.

	<VirtualHost *:80>
		DocumentRoot /var/www/anti-xss-demo/web
		ServerName anti-xss-demo.example.com
	</VirtualHost>

Note that in order to make the *.htaccess* effective, your main apache config file must allow subdirectory to override it.  

	<Directory "/var/www">
		AllowOverride All
	</Directory>


##Structure

* **app/** contains all files for your app: `models/`, `controllers/`, `views/` (Twig templates) and your `config/` (configuration). Slim is instantiated in `app/start.php`
* **vendor/** contains the libraries for your application, and you can update them with composer.
* **web/** is for your assets: js/css/img files. It should be the only folder publically available so your domain should point to this folder. `web/index.php` bootstraps the rest of the application.


##Writable Directory

* **app/storage/db/** contains SQLite database file.
* **app/storage/cache/twig/** contains the twig template cache.
* **app/storage/logs/** contains the error logs.

## License

Software licensed under the [MIT license](http://opensource.org/licenses/MIT)

----------