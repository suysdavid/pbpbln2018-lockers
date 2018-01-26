<?php

namespace App\Exception;

use App\Entity\Locker;
use Throwable;

class WrongAccessCodeException extends \DomainException
{
    public function __construct(string $message = 'Wrong access code', Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }

    public static function forLocker(Locker $locker, \Throwable $previous = null): self
    {
        return new self(sprintf('Invalid access code for locker "%s"', $locker->getNumber()), $previous);
    }
}
