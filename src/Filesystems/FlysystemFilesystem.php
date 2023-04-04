<?php namespace District09\BackupManager\Filesystems;

use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\MountManager;

/**
 * Class FlysystemFilesystem
 * @package District09\BackupManager\Filesystems
 */
class FlysystemFilesystem implements Filesystem
{
    /**
     * @var array|Flysystem[]
     */
    private $filesystems;

    public function __construct(array $filesystems = [])
    {
        $this->filesystems = $filesystems;
    }

    /**
     * @param string|null $type
     * @return bool
     */
    public function handles($type)
    {
        return strtolower($type ?? '') === 'flysystem';
    }

    public function get(array $config)
    {
        return $this->filesystems[$config['name']];
    }
}
