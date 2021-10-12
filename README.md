In order to run this application a local web server with mysql database is needed. You can run it with XAMP's apache and mysql.

Prior to testing the application, perform database migration from the root directoyy using the following command:
php bin/console doctrine:migrations:migrate

Before accessing the main functionalities of the application, register a new user (data will only be saved on your local database).

On the application you will be able to create new product categories and new products, see the list of all products with their information and search products by product category.
Moreover it comes with an api for specific product information based on inputed id of the product in JSON. API endpoint: /api/items/{id}
