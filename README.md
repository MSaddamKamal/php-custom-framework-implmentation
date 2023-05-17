# Scandiweb


Scandiweb challenge for Products Crud .
The project is built on `Vanila (Core) PHP` and `React.js`.

## Technology Stack
Develop backend `REST API` using `PHP` by implementing custom `MVC architecture`.
* PHP 
* MySQL

 Develop Frontend using `React.js (Latest)` SPA Framework.
* React.js 
* Bootstrap

## Demo

![Demo1](https://raw.githubusercontent.com/MSaddamKamal/wireMedia/main/scandi.gif)

## Production Url
* [Backend Apis Url](http://saddam.bemo.fixlo.co/api/v1/product/get)
* [Frontend Dashboard URL](http://dev.fame.fixlo.co/)


## Backend Code Highlights (PHP)
* Develop Custom MVC
* Object Oriented Programming
* Develop Product Factory For Different Products 
* REST Api Routes `product/get` `product/add` `product/deleteAll`
* Classes
    * Product Controller
    * ProductFactory
        * Book (Product Type)
        * Dvd (Product Type)
        * Furniture (Product Type)
    * Core Custom MVC
        * Request
        * Reponse
        * Router
        * Validation
        * DB Connection
        * Query Buider
        * App (DI Containter)

## Frontend Code Highlights (React)
* Function Based Components
* State Hooks
* Bootstrap For Desigining
  
## Project Features
* List Products
* Mass Delete Products
* Add Products



## Backend Installation Guide

Edit `config.php` in backend root folder and add your database credentials.

```bash
   'database' => [
        'name' => 'scandiweb',
        'username' => 'root',
        'password' => '',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            // Displays an error (rather than blank page) if DB access fails:
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
    ],

```


Install composer vendor packages by following command via [composer]

```bash
composer install
```

Mysql Databse Table Create By running the following in DB Editor e.g `PHPMYADMIN`

```bash
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float unsigned NOT NULL,
  `size` float unsigned DEFAULT NULL,
  `weight` float unsigned DEFAULT NULL,
  `height` float unsigned DEFAULT NULL,
  `width` float unsigned DEFAULT NULL,
  `length` float unsigned DEFAULT NULL,
  `productType` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sku` (`sku`)
);
```



[Node.js]: https://nodejs.org/en/
[npm]: https://www.npmjs.com/
[composer]:https://getcomposer.org/
[npm install]: https://docs.npmjs.com/getting-started/installing-npm-packages-locally
[sandbox]: https://docs.npmjs.com/getting-started/installing-npm-packages-locally



## Frontend React.js

Run following commands for running the server on local

```bash
npm start
```

For Production Built use
```bash
npm run build
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)

