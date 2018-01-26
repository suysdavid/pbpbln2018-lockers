<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HelloWorldController extends Controller
{
    /**
     * @Route("/hello", name="hello", methods={"GET"})
     *
     * @return Response
     */
    public function hello(): Response
    {
        return $this->render('hello.html.twig', ['name' => 'David']);
    }
}
