<?php

namespace App\Controller;

use MongoDB\BSON\Regex;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \MongoDB\Driver\Exception\Exception
     */
    public function index(Request $request)
    {
        // 初始化查询条件
        $filter = [];
        $options = [
            'sort' => ['name' => -1],
        ];
        // 按姓名模糊查询
        $name = $request->query->get('name');
        if (!empty($name)) {
            $filter['name'] = new Regex($name);
        }
        //

        $collection = (new \MongoDB\Client)->demo->job;
        $cursor = $collection->find($filter, $options);
        $list = $cursor->toArray();
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
            'keyword' => [
                'name' => $name,
            ],
            'list' => $list,
            'size' => count($list),
        ]);
    }
}
