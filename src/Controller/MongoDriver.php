<?php

namespace App\Controller;

use MongoDB\Driver\Manager;

/**
 * 数据库驱动单例
 * @package App\Controller
 */
class MongoDriver
{
    private static $instance = null;

    public static function instance()
    {
        if (self::$instance != null) {
            return self::$instance;
        }
        return self::$instance = new Manager("mongodb://localhost:27017");

    }
}
