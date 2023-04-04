<?php

namespace District09\BackupManager\Filesystems;

/**
 * Interface Filesystem
 * @package District09\BackupManager\Filesystems
 */
interface Filesystem
{
    /**
     * Test fitness of visitor.
     * @param string|null $type
     * @return bool
     */
    public function handles($type);

    /**
     * @param array $config
     * @return \League\Flysystem\Filesystem
     */
    public function get(array $config);
}
