<?php

namespace App\Command;

use App\LockerManagement\LockerManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class LockerDepositPackageCommand extends Command
{
    protected static $defaultName = 'locker:deposit-package';
    private $lockerManager;

    public function __construct(LockerManager $lockerManager)
    {
        parent::__construct(static::$defaultName);

        $this->lockerManager = $lockerManager;
    }

    protected function configure()
    {
        $this
            ->setDescription(
                'Deposit a package and add accessCode'
            )//    ->addArgument('locker', InputArgument::REQUIRED, 'Locker ID')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$lockerNumber = $input->getArgument('locker');
        $io = new SymfonyStyle($input, $output);
        $lockerNumber = $io->ask('Please enter a locker number');

        $accessCode = $this->lockerManager->depositPackage($lockerNumber);

        $io->success(sprintf('Package deposited in locker "%s" with accessCode "%s"', $lockerNumber, $accessCode));
    }
}
