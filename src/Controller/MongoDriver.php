<?php

namespace App\Controller;

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
        return self::$instance = new \MongoDB\Driver\Manager("mongodb://localhost:27017");

    }
}
