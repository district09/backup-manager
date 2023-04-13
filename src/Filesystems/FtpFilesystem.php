<?php namespace District09\BackupManager\Filesystems;

use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\PhpseclibV3\SftpAdapter;
use League\Flysystem\PhpseclibV3\SftpConnectionProvider;

/**
 * Class FtpFilesystem
 * @package District09\BackupManager\Filesystems
 */
class FtpFilesystem implements Filesystem
{
    /**
     * Test fitness of visitor.
     * @param string|null $type
     * @return bool
     */
    public function handles($type)
    {
        return strtolower($type ?? '') == 'ftp';
    }

    /**
     * @param array $config
     * @return Flysystem
     */
    public function get(array $config)
    {
        return new Flysystem(new SftpAdapter(SftpConnectionProvider::fromArray($config), $config['root']));
    }
}
