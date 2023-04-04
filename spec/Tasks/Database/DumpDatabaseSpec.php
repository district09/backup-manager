<?php namespace spec\District09\BackupManager\Tasks\Database;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use District09\BackupManager\Databases\Database;
use District09\BackupManager\ShellProcessing\ShellProcessor;

class DumpDatabaseSpec extends ObjectBehavior
{
    public function it_is_initializable(Database $database, ShellProcessor $shellProcessor)
    {
        $this->beConstructedWith($database, 'path', $shellProcessor);
        $this->shouldHaveType('District09\BackupManager\Tasks\Database\DumpDatabase');
    }

    public function it_should_execute_the_database_dump_command(Database $database, ShellProcessor $shellProcessor)
    {
        $database->getDumpCommandLine('path')->willReturn('dump path');
        $shellProcessor->process(Argument::any())->shouldBeCalled();

        $this->beConstructedWith($database, 'path', $shellProcessor);
        $this->execute();
    }
}
