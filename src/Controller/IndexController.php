<?php

namespace App\Controller;

use MongoDB\BSON\ObjectId;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * 首页控制器
 * @package App\Controller
 */
class IndexController extends Controller
{
    /**
     * 首页
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index/index.html.twig');
    }

    /**
     * 添加新候选人
     * @Route("/candidate/save",name="candidate/save")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function save(Request $request)
    {
        $form_data = $request->request->all();
        // 表单过滤
        $form_data['name'] = htmlspecialchars(trim($form_data['name']));
        $form_data['nation'] = htmlspecialchars(trim($form_data['nation']));

        // 表单检查
        if (empty($form_data['name'])) {
            return $this->json([
                'status' => 0,
                'info' => '姓名不能为空',
            ]);
        }
        if (!in_array($form_data['sex'], ['男', '女'])) {
            return $this->json([
                'status' => 0,
                'info' => '性别不能为空',
            ]);
        }
        if (!preg_match('/^1[0-9]+$/', $form_data['phone'])) {
            return $this->json([
                'status' => 0,
                'info' => '联系电话不合法',
            ]);
        }
        if (empty($form_data['hunyin']) || empty($form_data['shengyu'])) {
            return $this->json([
                'status' => 0,
                'info' => '婚姻和生育情况不能为空',
            ]);
        }
        if (empty($form_data['job_name'])) {
            return $this->json([
                'status' => 0,
                'info' => '应聘职位不能为空',
            ]);
        }
        // 组织数据
        $document = [
            '_id' => new ObjectID,
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
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        // 写入数据库
        $collection = (new \MongoDB\Client)->demo->job;
        $result = $collection->insertOne($document);
        // 返回结果
        return $this->json([
            'status' => 1,
            'info' => '提交成功',
            'data' => $form_data,
        ]);
    }
}
