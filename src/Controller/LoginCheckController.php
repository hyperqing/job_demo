<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * 登录检查控制器
 * @package App\Controller
 */
class LoginCheckController extends Controller
{
    public function __construct()
    {
        $request = Request::createFromGlobals();
        if (!$request->getSession()->get('user')) {
            return $this->redirectToRoute('login');
        }
    }
}