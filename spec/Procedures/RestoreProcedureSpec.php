<?php

namespace spec\District09\BackupManager\Procedures;

use District09\BackupManager\Compressors\CompressorProvider;
use District09\BackupManager\Databases\DatabaseProvider;
use District09\BackupManager\Filesystems\FilesystemProvider;
use District09\BackupManager\Procedures\Sequence;
use District09\BackupManager\ShellProcessing\ShellProcessor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RestoreProcedureSpec extends ObjectBehavior
{
    public function it_is_initializable(FilesystemProvider $filesystemProvider, DatabaseProvider $databaseProvider, CompressorProvider $compressorProvider, ShellProcessor $shellProcessor, Sequence $sequence)
    {
        $this->beConstructedWith($filesystemProvider, $databaseProvider, $compressorProvider, $shellProcessor, $sequence);
        $this->shouldHaveType('District09\BackupManager\Procedures\RestoreProcedure');
    }
}
