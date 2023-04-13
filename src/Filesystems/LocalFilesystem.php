<?php namespace District09\BackupManager\Filesystems;

use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\Local\LocalFilesystemAdapter;

/**
 * Class LocalFilesystem
 * @package District09\BackupManager\Filesystems
 */
class LocalFilesystem implements Filesystem
{
    /**
     * Test fitness of visitor.
     * @param string|null $type
     * @return bool
     */
    public function handles($type)
    {
        return strtolower($type ?? '') == 'local';
    }

    /**
     * @param array $config
     * @return Flysystem
     */
    public function get(array $config)
    {
        return new Flysystem(new LocalFilesystemAdapter($config['root']));
    }
}
