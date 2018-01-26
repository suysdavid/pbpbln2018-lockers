<?php

namespace App\Controller;

use App\Services\TestInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HelloWorldController
{
    private $test;
    private $twig;
    private $greeting;

    public function __construct(Environment $twig, TestInterface $test, string $greeting)
    {
        $this->test = $test;
        $this->twig = $twig;
        $this->greeting = $greeting;
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
        return new Response(
            $this->twig->render(
                'hello.html.twig',
                [
                    'greeting' => $this->greeting,
                    'name' => $this->test->getName(),
                ]
            )
        );
    }
}
