<?php

namespace App\LockerManagement;

use App\Entity\Locker;
use App\Repository\LockerRepository;
use Doctrine\Common\Persistence\ObjectManager;

class LockerManager
{
    private $lockerRepository;
    private $objectManager;
    private $accessCodeGenerator;

    public function __construct(
        LockerRepository $lockerRepository,
        ObjectManager $objectManager,
        AccessCodeGenerator $accessCodeGenerator
    ) {
        $this->lockerRepository = $lockerRepository;
        $this->objectManager = $objectManager;
        $this->accessCodeGenerator = $accessCodeGenerator;
    }

    public function depositPackage(string $lockerNumber): string
    {
        /** @var Locker $locker */
        $locker = $this->lockerRepository->findOneBy(['number' => $lockerNumber]);
        $accessCode = $this->accessCodeGenerator->generate();
        $locker->depositPackage($accessCode);
        $this->objectManager->flush();

        return $accessCode;
    }
}
