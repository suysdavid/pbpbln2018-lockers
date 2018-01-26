<?php

namespace App\Controller;

use App\Entity\Locker;
use App\Exception\WrongAccessCodeException;
use App\LockerManagement\LockerManager;
use App\Repository\LockerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("lockers/{number}", name="locker_view", methods={"GET"}, requirements={"number":"[a-zA-Z0-9]+"})
     */
    public function locker(Locker $locker): Response
    {
        return $this->render('locker/view.html.twig', ['locker' => $locker]);
    }

    /**
     * @Route("/lockers/pick-up", name="locker_pickup", methods={"POST"})
     *
     * @param Request       $request
     * @param LockerManager $lockerManager
     *
     * @return Response
     */
    public function pickUpPackage(Request $request, LockerManager $lockerManager): Response
    {
        try {
            $lockerManager->pickupPackage($request->get('access_code'));
            $this->addFlash('success', 'Package was picked up and locker was freed');
        } catch (WrongAccessCodeException $e) {
            $this->addFlash('error', $e->getMessage());
        }

        return $this->redirectToRoute('locker_list');
    }
}
