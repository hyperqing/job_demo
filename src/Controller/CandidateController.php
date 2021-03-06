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
     * 删除候选人
     * @Route("/candidate/delete",name="candidate/delete")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function delete(Request $request)
    {
        $id = $request->request->get('id');
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
                    'nation' => $form_data['nation'],
                    'birth_place' => $form_data['birth_place'],

                    'birthday' => $form_data['birthday'],
                    'phone' => $form_data['phone'],
                    'address' => $form_data['address'],

                    'working_life' => $form_data['working_life'],
                    'hunyin' => $form_data['hunyin'],
                    'shengyu' => $form_data['shengyu'],

                    'education' => $form_data['education'],
                    'work' => $form_data['work'],
                    'family' => $form_data['family'],

                    'job_name' => $form_data['job_name'],
                    'job_property' => $form_data['job_property'],
                    'my_level' => $form_data['my_level'],
                    'salary_require' => $form_data['salary_require'],
                    'come_time' => $form_data['come_time'],
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
