<?php namespace District09\BackupManager\Filesystems;

use League\Flysystem\Filesystem as Flysystem;

/**
 * @package District09\BackupManager\Filesystems
 */
class DropboxV2Filesystem extends DropboxFilesystem
{
    /**
     * Test fitness of visitor.
     * @param string|null $type
     * @return bool
     */
    public function handles($type)
    {
        return strtolower($type ?? '') == 'dropboxv2';
    }
}
