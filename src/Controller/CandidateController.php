<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * 候选人控制器
 * @package App\Controller
 */
class CandidateController extends Controller
{
    /**
     * 添加新候选人
     * @Route("/candidate/save",name="candidate/save")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function save(Request $request)
    {
        $form_data = $request->request->all();
        // TODO 过滤操作
        // 组织数据
        $document = [
            '_id' => new \MongoDB\BSON\ObjectID,
            'name' => $form_data['name'],
            'sex' => $form_data['sex'],
        ];
        // 写入数据库
        $bulk = new \MongoDB\Driver\BulkWrite;
        $_id = $bulk->insert($document);
        $writeConcern = new \MongoDB\Driver\WriteConcern(\MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result = MongoDriver::instance()->executeBulkWrite('demo.job', $bulk, $writeConcern);
        // 返回结果
        return $this->json([
            'status' => 1,
            'info' => '添加成功',
            'data' => $form_data,
        ]);
    }
}
