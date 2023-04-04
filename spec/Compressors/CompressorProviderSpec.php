<?php

namespace spec\District09\BackupManager\Compressors;

use District09\BackupManager\Compressors\GzipCompressor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompressorProviderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('District09\BackupManager\Compressors\CompressorProvider');
    }

    public function it_should_provide_compressors_by_name()
    {
        $this->add(new GzipCompressor);
        $this->get('gzip')->shouldHaveType('District09\BackupManager\Compressors\GzipCompressor');
    }

    public function it_should_throw_an_exception_if_it_cant_find_a_compressor()
    {
        $this->shouldThrow('District09\BackupManager\Compressors\CompressorTypeNotSupported')->during('get', ['unsupported']);
    }
}
