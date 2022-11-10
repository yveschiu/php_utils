# About this repo
A place to house some simple util classes and functions

## How to use composer to install this tiny tool
- Add the following lines to the composer.json file
```
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/yveschiu/php_utils.git"
        }
    ],
    "require": {
        "yveschiu/php_utils": "dev-main"
    }
}
```
- Use composer install to get it


## Databases
A singleton MySQL database object that can prevent multiple building multiple connections within the execution of an app.

### Usage
1. Configuration
- Add these lines of settings of the MySQL configuration in `.env` file in the project root.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE="ENTER YOUR DATABASE NAME"
DB_USERNAME="ENTER YOUR USERNAME"
DB_PASSWORD="ENTER YOUR PASSWORD"
DB_CHARSET="utf8mb4"
DSN="${DB_CONNECTION}:host=${DB_HOST};port=${DB_PORT};dbname=${DB_DATABASE};charset=${DB_CHARSET};"
# set timezone: utc +x:xx
DB_TIMEZONE="+0:00"
```
2. Usage
- The main purpose of this Database class is just to let you get the PDO easily from anywhere and do nothing else.
```
use Yveschiu\PhpUtils\Databases\MySQL\Database;

$db = Database::get(); // get the PDO object to interact with database
```
- see `Test.php` to get a basic idea.
