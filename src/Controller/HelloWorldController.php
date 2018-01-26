<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class HelloWorldController
{
    /**
     * @Route("/hello", name="hello", methods={"GET"})
     *
     * @return Response
     */
    public function hello(): Response
    {
        return new Response('Hello David');
    }
}
