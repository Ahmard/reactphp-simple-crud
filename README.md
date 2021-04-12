# ReactPHP DB CRUD
[ReactPHP](https://reactphp.org) simple database crud operation.

## Installation
Clone this repo
```
git clone https://github.com/Ahmard/reactphp-crud.git
```

Install [composer](https://getcomposer.org) packages
```
cd reactphp-crud
composer update
```

## DB Config
Edit [.env](.env) file add update it with DB credentials
```dotenv
DB_USER = "root"
DB_PASS = "password"
DB_HOST = "127.0.0.1"
DB_NAME = "myDatabase"
```

## Install DB Tables
Before using this crud demo, DB tables must be installed first.
```bash
php create-tables.php
```

## Running Demo

[Create](create.php) new user
```
php create.php
```

[Read](read.php) user info
```
php read.php
```

[Update](update.php) user info
```
php create.php
```

[Delete](delete.php) user
```
php delete.php
```

[List all users](list.php)
```
php list.php
```