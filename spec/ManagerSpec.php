<?php

namespace spec\BackupManager;

use District09\BackupManager\Compressors\CompressorProvider;
use District09\BackupManager\Databases\DatabaseProvider;
use District09\BackupManager\Filesystems\FilesystemProvider;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ManagerSpec extends ObjectBehavior
{
    public function let(FilesystemProvider $filesystems, DatabaseProvider $databases, CompressorProvider $compressors)
    {
        $this->beConstructedWith($filesystems, $databases, $compressors);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('District09\BackupManager\Manager');
    }

    public function it_should_create_a_backup_procedure()
    {
        $this->makeBackup()->shouldHaveType('District09\BackupManager\Procedures\BackupProcedure');
    }

    public function it_should_create_a_restore_procedure()
    {
        $this->makeRestore()->shouldHaveType('District09\BackupManager\Procedures\RestoreProcedure');
    }
}
