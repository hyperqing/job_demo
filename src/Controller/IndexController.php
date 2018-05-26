<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * 首页控制器
 * @package App\Controller
 */
class IndexController extends Controller
{
    /**
     * 首页
     * @Route("/", name="_index")
     */
    public function index()
    {
        return $this->render('index/index.html.twig');
    }
}
