<?php

namespace App\Controller;

use App\Services\TestInterface;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HelloWorldController
{
    private $twig;

    private $test;

    public function __construct(Environment $twig, TestInterface $test)
    {
        $this->twig = $twig;
        $this->test = $test;
    }

    /**
     * @Route("/hello", name="hello", methods={"GET"})
     *
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function hello(): Response
    {
        return new Response($this->twig->render('hello.html.twig', ['name' => 'David']));
    }
}
