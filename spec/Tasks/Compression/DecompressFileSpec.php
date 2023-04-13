<?php

namespace spec\District09\BackupManager\Tasks\Compression;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use District09\BackupManager\Compressors\Compressor;
use District09\BackupManager\ShellProcessing\ShellProcessor;

class DecompressFileSpec extends ObjectBehavior
{
    public function it_is_initializable(Compressor $compressor, ShellProcessor $shellProcessor)
    {
        $this->beConstructedWith($compressor, 'path', $shellProcessor);
        $this->shouldHaveType('District09\BackupManager\Tasks\Compression\DecompressFile');
    }

    public function it_should_execute_the_decompression_command(Compressor $compressor, ShellProcessor $shellProcessor)
    {
        $compressor->getDecompressCommandLine('path')->willReturn('decompress path');
        $shellProcessor->process(Argument::any())->shouldBeCalled();

        $this->beConstructedWith($compressor, 'path', $shellProcessor);
        $this->execute();
    }
}
