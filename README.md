In order to run this application a local web server with mysql database and composer are needed. You can run it with XAMPP's apache and mysql.

Download xampp: https://www.apachefriends.org/download.html PHP 8.0.11 for your operating system.

Download and install composer: https://getcomposer.org/download/ 

Start XAMPP's apache and mysql services via XAMPP control panel.

Clone the git project into xampp/htdocs folder for e.g. xampp/htdocs/ProductCatalog

Navigate to the root directory of the project (you can use cmd, gitbash, terminal) for e.g. cd xampp/htdocs/ProductCatalog

Install required dependencies with the following command: composer require symfony/runtime

On XAMPP control panel click shell tye in the following command: mysqladmin  -u db_user password

When prompted for password type in : db_password

Once database user is created you will need to perform a migration.

Perform database migration from the root directory with the  following command: php bin/console doctrine:migrations:migrate

Open your web browser to check the web application localhost/ProductCatalog/public/index.php

Before accessing the main functionalities of the application, register a new user by clicking "register" (data will only be saved on your local database).

On the application you will be able to create new product categories and new products, see the list of all products with their information and search products by product category.
Moreover it comes with an api for specific product information based on inputed id of the product in JSON. API endpoint: /api/items/{id}
