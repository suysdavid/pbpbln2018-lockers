<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LockerRepository")
 */
class Locker
{
    public const STATUS_FREE         = 'free';
    public const STATUS_IN_USE       = 'in_use';
    public const STATUS_OUT_OF_ORDER = 'out_of_order';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(length=5, unique=true)
     */
    private $number;
    /**
     * @ORM\Column(length=20)
     */
    private $status;
    /**
     * @ORM\Column(nullable=true)
     */
    private $accessCode;

    public function __construct(string $number, string $status = self::STATUS_FREE)
    {
        $this->number = $number;
        $this->status = $status;
    }

    public function setAccessCode(string $accessCode): void
    {
        $this->accessCode = $accessCode;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function depositPackage(string $accessCode): void
    {
        if ($this->status !== self::STATUS_FREE) {
            throw new \LogicException('Locker is not free');
        }
        $this->status = self::STATUS_IN_USE;
        $this->accessCode = $accessCode;
    }

    public function pickUpPackage(string $accessCode): void
    {
        if (self::STATUS_IN_USE !== $this->status) {
            throw new \LogicException('Locker is not in use');
        }
        if ($accessCode !== $this->accessCode) {
            throw new \InvalidArgumentException('Invalid access code');
        }
        $this->accessCode = null;
        $this->status = self::STATUS_FREE;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
