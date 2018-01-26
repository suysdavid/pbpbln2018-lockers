<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HelloWorldController
{
    /**
     * @Route("/hello", name="hello", methods={"GET"})
     *
     * @param Environment $twig
     *
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function hello(Environment $twig): Response
    {
        return new Response($twig->render('hello.html.twig', ['name' => 'David']));
    }
}
