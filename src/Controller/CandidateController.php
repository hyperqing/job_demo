<?php

namespace App\Controller;

use MongoDB\BSON\ObjectId;
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
            'phone' => $form_data['phone'],
            'birthday' => $form_data['birthday'],
            'education' => $form_data['education'] ?? null, // TODO
            'job_name' => $form_data['job_name'],
            'job_property' => $form_data['job_property'],
            'status' => '待面试',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        // 写入数据库
        $bulk = new \MongoDB\Driver\BulkWrite;
        $_id = $bulk->insert($document);
        $result = MongoDriver::instance()->executeBulkWrite('demo.job', $bulk);
        // 返回结果
        return $this->json([
            'status' => 1,
            'info' => '添加成功',
            'data' => $form_data,
        ]);
    }

    /**
     * 删除候选人
     * @Route("/candidate/delete",name="candidate/delete")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function delete(Request $request)
    {
        $id = $request->request->get('id');
        // TODO 过滤检查
        $bulk = new \MongoDB\Driver\BulkWrite;
        $bulk->delete(['_id' => new ObjectId($id)]);
        $result = MongoDriver::instance()->executeBulkWrite('demo.job', $bulk);
        return $this->json([
            'status' => 1,
            'info' => '删除成功',
        ]);
    }
}
