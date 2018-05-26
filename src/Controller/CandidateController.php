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
     * @Route("/candidate/save",name="_candidate_save")
     */
    public function save(Request $request)
    {
        $form_data = $request->request->all();
        return $this->json([
            'status' => 1,
            'info' => '添加成功',
            'data' => $form_data,
        ]);
    }
}
