<?php

namespace spec\District09\BackupManager\Filesystems;

use PhpSpec\Exception\Example\SkippingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FtpFilesystemSpec extends ObjectBehavior
{
    public function let(): void
    {
        if (!class_exists('League\Flysystem\PhpseclibV3\SftpAdapter')) {
            throw new SkippingException('Requires Flysystem PhpseclibV3');
        }
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('District09\BackupManager\Filesystems\FtpFilesystem');
    }

    public function it_should_recognize_its_type_with_case_insensitivity()
    {
        foreach (['ftp', 'Ftp', 'FTP'] as $type) {
            $this->handles($type)->shouldBe(true);
        }

        foreach ([null, 'foo'] as $type) {
            $this->handles($type)->shouldBe(false);
        }
    }

    public function getConfig()
    {
        return [
            'host'     => 'ftp.example.com',
            'username' => 'example.com',
            'password' => 'password',
        ];
    }
}
