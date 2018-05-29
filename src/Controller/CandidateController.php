<?php

namespace App\Controller;

use MongoDB\BSON\ObjectId;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * 候选人控制器
 * @package App\Controller
 */
class CandidateController extends LoginCheckController
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
            'education' => $form_data['education'],
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
            'info' => '提交成功',
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

    /**
     * 编辑候选人
     * @Route("/candidate/edit", name="candidate/edit")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \MongoDB\Driver\Exception\Exception
     */
    public function edit(Request $request)
    {
        $collection = (new \MongoDB\Client)->demo->job;
        $document = $collection->findOne([
            '_id' => new ObjectId($request->query->get('_id'))
        ]);
        // 查询数据
        return $this->render('candidate/edit.html.twig', [
            'user' => $document
        ]);
    }

    /**
     * 候选人信息保存更改
     * @Route("/candidate/update", name="candidate/update")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function update(Request $request)
    {
        $form_data = $request->request->all();
        $collection = (new \MongoDB\Client)->demo->job;
        $updateResult = $collection->updateOne(
            [
                '_id' => new ObjectId($request->request->get('_id'))
            ],
            [
                '$set' => [
                    'name' => $form_data['name'],
                    'sex' => $form_data['sex'],
                    'phone' => $form_data['phone'],
                    'birthday' => $form_data['birthday'],
                    'education' => $form_data['education'],
                    'job_name' => $form_data['job_name'],
                    'job_property' => $form_data['job_property'],
                    'status' => '待面试',
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]
        );
        if ($updateResult->getModifiedCount() === 0) {
            // 返回结果
            return $this->json([
                'status' => 0,
                'info' => '保存失败',
                'data' => $form_data,
            ]);
        }
        // 返回结果
        return $this->json([
            'status' => 1,
            'info' => '保存成功',
            'data' => $form_data,
        ]);


    }
}
