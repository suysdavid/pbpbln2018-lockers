<?php

namespace App\LockerManagement;

use App\Entity\Locker;
use App\Exception\WrongAccessCodeException;
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

    public function pickupPackage(string $accessCode): void
    {
        /** @var Locker $locker */
        $locker = $this->lockerRepository->findOneBy(['accessCode' => $accessCode]);
        if (!$locker) {
            throw new WrongAccessCodeException('Invalid Access Code');
        }
        $locker->pickUpPackage($accessCode);
        $this->objectManager->flush();
    }
}
