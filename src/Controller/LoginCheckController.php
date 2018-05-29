<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class LoginCheckController extends Controller
{
    /**
     * 登录检查
     * @param SessionInterface $session
     * @param RouterInterface $router
     */
    public function __construct(SessionInterface $session, RouterInterface $router)
    {
        if (!$session->has('user_name')) {
            $response = new RedirectResponse(
                $router->generate(
                    'login',
                    [],
                    UrlGeneratorInterface::ABSOLUTE_URL
                )
            );
            $response->send();
        }
    }
}
