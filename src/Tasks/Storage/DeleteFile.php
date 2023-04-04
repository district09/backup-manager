<?php namespace District09\BackupManager\Tasks\Storage;

use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;
use District09\BackupManager\Tasks\Task;
use League\Flysystem\FilesystemException;

/**
 * Class DeleteFile
 * @package District09\BackupManager\Tasks\Storage
 */
class DeleteFile implements Task
{
    /** @var Filesystem */
    private $filesystem;
    /** @var string */
    private $filePath;

    /**
     * @param Filesystem $filesystem
     * @param string $filePath
     */
    public function __construct(Filesystem $filesystem, $filePath)
    {
        $this->filesystem = $filesystem;
        $this->filePath = $filePath;
    }

    /**
     * @return bool
     * @throws FilesystemException
     */
    public function execute()
    {
        $this->filesystem->delete($this->filePath);

        return true;
    }
}
