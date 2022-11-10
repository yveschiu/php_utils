<?php

require __DIR__ . '/vendor/autoload.php';

use Yveschiu\PhpUtils\Databases\MySQL\Database;

class Test
{
    /**
     * Just a single select query without prepare stmt to test the functionality
     * Please make sure that your have a employees table in your database
     */
    public static function testMySQLDatabaseSingleton(): void
    {
        $tableName = 'employees';
        $db = Database::get();
        $query = "select * from {$tableName}";
        $stmt = $db->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "result: " . PHP_EOL;
        print_r($result);
    }

    public static function main(): void
    {
        self::testMySQLDatabaseSingleton();
    }
}

Test::main();
