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
        $corsor = MongoDriver::instance()->executeQuery('demo.job', $query);
        $list = $corsor->toArray();
        foreach ($list as &$item) {
            // 取第一条记录为最高学历
            if (count($item->education) !== 0 && isset($item->education[0])) {
                $item->education = $item->education[0];
            }
        }
        return $this->render('admin/index.html.twig', [
            'list' => $list,
            'size' => count($list),
        ]);
    }
}
