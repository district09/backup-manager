<?php namespace BackupManager\Filesystems;

use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\PhpseclibV3\SftpAdapter;

/**
 * Class SftpFilesystem
 * @package BackupManager\Filesystems
 */
class SftpFilesystem extends FtpFilesystem
{
    /**
     * Test fitness of visitor.
     * @param string|null $type
     * @return bool
     */
    public function handles($type)
    {
        return strtolower($type ?? '') == 'sftp';
    }
}
