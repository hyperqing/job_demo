<?php

namespace App\Controller;

use MongoDB\Driver\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * 首页控制器
 * @package App\Controller
 */
class IndexController extends Controller
{
    /**
     * 首页
     * @Route("/", name="_index")
     */
    public function index()
    {
        $bulk = new \MongoDB\Driver\BulkWrite;
        $document = ['_id' => new \MongoDB\BSON\ObjectID, 'name' => '菜鸟教程'];

        $_id= $bulk->insert($document);

        var_dump($_id);

        $manager = new \MongoDB\Driver\Manager("mongodb://127.0.0.1:27017");
        $writeConcern = new \MongoDB\Driver\WriteConcern(\MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result = $manager->executeBulkWrite('test.runoob', $bulk, $writeConcern);
        return $this->render('index/index.html.twig');
    }
}
