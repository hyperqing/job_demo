<?php

namespace App\Controller;

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
     * @Route("/admin",name="_admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }
}
