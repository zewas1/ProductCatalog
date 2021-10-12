In order to run this application a local web server with mysql database and composer are needed. You can run it with XAMPP's apache and mysql.

Download xampp: https://www.apachefriends.org/download.html PHP 8.0.11 for your operating system.

Download and install composer: https://getcomposer.org/download/ 

Start XAMPP's apache and mysql services via XAMPP control panel.

Clone the git project into xampp/htdocs folder for e.g. xampp/htdocs/ProductCatalog

Navigate to the root directory of the project (you can use cmd, gitbash, terminal) for e.g. cd xampp/htdocs/ProductCatalog

Install required dependencies with the following command: composer require symfony/runtime

Via XAMPP's control panel either use shell or "Admin" next to mysql to create a new database user, which will be used to access the database (user: db_user , password: db_password @localhost), also create a new database called "productcatalog". You can find one example of how to do it with XAMPP's phpmyadmin here: http://www.cs.virginia.edu/~up3f/cs4750/supplement/DB-setup-xampp.html

Perform database migration from the root directory (xampp/htdocs/ProductCatalog) with the  following command: php bin/console doctrine:migrations:migrate

Open your web browser to check the web application localhost/ProductCatalog/public/index.php

Before accessing the main functionalities of the application, register a new user by clicking "register" (data will only be saved on your local database).

On the application you will be able to create new product categories and new products, see the list of all products with their information and search products by product category.
Moreover it comes with an api for specific product information based on inputed id of the product in JSON. API endpoint: /api/items/{id}
