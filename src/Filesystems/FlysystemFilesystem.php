<?php namespace BackupManager\Filesystems;

use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\MountManager;

/**
 * Class FlysystemFilesystem
 * @package BackupManager\Filesystems
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
     * @param string $type
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
