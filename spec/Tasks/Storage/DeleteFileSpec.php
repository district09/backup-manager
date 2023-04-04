<?php

namespace spec\District09\BackupManager\Tasks\Storage;

use League\Flysystem\Filesystem;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeleteFileSpec extends ObjectBehavior
{
    public function it_is_initializable(Filesystem $filesystem)
    {
        $this->beConstructedWith($filesystem, 'path');
        $this->shouldHaveType('District09\BackupManager\Tasks\Storage\DeleteFile');
    }

    public function it_should_execute_the_delete_file_command(Filesystem $filesystem)
    {
        $filesystem->delete('path')->shouldBeCalled();

        $this->beConstructedWith($filesystem, 'path');
        $this->execute();
    }
}
