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
            // 精简时间
            $item->created_at = explode(' ', $item->created_at)[0];
            // 取第一条记录为最高学历
            if (count($item->education) !== 0 && isset($item->education[0])) {
                $item->education = $item->education[0];
            }
            // 生成修改页面链接
            $item->edit_url = $this->generateUrl('candidate/edit', [
                '_id' => (string)$item->_id
            ]);
        }
        return $this->render('admin/index.html.twig', [
            'list' => $list,
            'size' => count($list),
        ]);
    }
}
