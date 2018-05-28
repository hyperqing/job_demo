<?php

namespace App\Controller;

use MongoDB\Driver\Query;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * 后台控制器
 * @package App\Controller
 */
class AdminController extends Controller
{
    /**
     * 后台首页
     * @Route("/admin",name="admin")
     * @throws \MongoDB\Driver\Exception\Exception
     */
    public function index()
    {
        $filter = [];
        $options = [
            'projection' => ['_id' => 0],
            'sort' => ['x' => -1],
        ];
        // 查询数据
        $query = new Query($filter);
        $result = MongoDriver::instance()->executeQuery('demo.job', $query);
        return $this->render('admin/index.html.twig',[
            'list' => $result
        ]);
    }
}
