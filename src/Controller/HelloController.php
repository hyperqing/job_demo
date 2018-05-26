<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HelloController
 * @package App\Controller
 */
class HelloController extends Controller
{
    /**
     * @Route("/hello/abc")
     */
    public function numberAction()
    {
        $number = mt_rand(0, 100);

        return $this->render('hello/number.html.twig', [
            'number' => $number,
            'link' => $url = $this->generateUrl('/hello/number', array('max' => 10)),
        ]);

        return new Response(
            '<html><body>Lucky number: ' . $number . '</body></html>'
        );
    }
}
