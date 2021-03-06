<?php

namespace PHPChunkit\Test\Command;

use PHPChunkit\Command\CreateDatabases;
use PHPChunkit\DatabaseSandbox;
use PHPChunkit\Events;
use PHPChunkit\TestRunner;
use PHPChunkit\Test\BaseTest;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class CreateDatabasesTest extends BaseTest
{
    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * @var CreateDatabases
     */
    private $createDatabases;

    protected function setUp()
    {
        $this->eventDispatcher = $this->createMock(EventDispatcher::class);

        $this->createDatabases = new CreateDatabases(
            $this->eventDispatcher
        );
    }

    public function testExecute()
    {
        $input = $this->createMock(InputInterface::class);
        $output = $this->createMock(OutputInterface::class);

        $this->eventDispatcher->expects($this->once())
            ->method('dispatch')
            ->with(Events::DATABASES_CREATE);

        $this->createDatabases->execute($input, $output);
    }
}
