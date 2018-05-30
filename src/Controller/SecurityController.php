<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request, SessionInterface $session)
    {
        if ($request->isMethod('get')) {
            return $this->render('security/login.html.twig');
        }
        // 登录操作
        $user_name = $request->request->get('user_name');
        $user_pwd = $request->request->get('user_pwd');
        $collection = (new \MongoDB\Client)->demo->user;
        $document = $collection->findOne([
            'user_name' => $user_name,
        ]);
        if (!$document) {
            return $this->json([
                'status' => 0,
                'info' => '没有找到用户',
            ]);
        }
        if (!password_verify($user_pwd, $document['user_pwd'])) {
            return $this->json([
                'status' => 0,
                'info' => '账号或密码错误',
            ]);
        }
        $session->set('user_name', $user_name);
        return $this->json([
            'status' => 1,
            'info' => '登录成功',
        ]);
    }

    /**
     * 退出登录
     * @Route("/logout", name="logout")
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function logout(SessionInterface $session)
    {
        $session->clear();
        return $this->redirectToRoute('login');
    }
}
