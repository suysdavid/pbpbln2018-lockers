<?php

namespace App\Controller;

use App\Repository\LockerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class LockerController extends Controller
{
    private $lockerRepository;

    public function __construct(LockerRepository $lockerRepository)
    {
        $this->lockerRepository = $lockerRepository;
    }

    /**
     * @Route("/lockers", name="locker_list")
     */
    public function index(): Response
    {
        return $this->render(
            'locker/list.html.twig',
            [
                'lockers' => $this->lockerRepository->findAll(),
            ]
        );
    }
}
