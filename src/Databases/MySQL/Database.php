<?php

/**
 * singleton pattern
 */

namespace Yveschiu\PhpUtils\Databases\MySQL;

use Dotenv\Dotenv;
use PDO;
use Exception;

class Database
{
    private static PDO $instance;

    private function __construct()
    {
        // 把建構子設成私有變數，避免在外部被初始化
        // 外部不能自己使用 new Database() 來呼叫 PDO連線物件
    }

    private static function getInstance()
    {
        if (!isset(self::$instance)) {
            // 載入 .env 設定檔
            $dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));
            $dotenv->load();
            // 額外的連線設定
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '{$_ENV['DB_TIMEZONE']}'"
            ];
            try {
                self::$instance = new PDO(
                    $_ENV['DSN'],
                    $_ENV['DB_USERNAME'],
                    $_ENV['DB_PASSWORD'],
                    $options
                );
            } catch (Exception $e) {
                echo "Couldn't connect to the database" . $e->getMessage() . PHP_EOL;
            }
        }
        return self::$instance;
    }

    /**
     * @return PDO
     */
    public static function get(): PDO|null
    {
        return self::getInstance() ?? null;
    }

    /**
     * destructor
     */
    public static function unlinkPDO(): void
    {
        if (isset(self::$instance)) {
            // 物件 0參考時會自動解構
            self::$instance = null;
        }
    }
}
