<?php namespace District09\BackupManager\Tasks\Storage;

use League\Flysystem\Filesystem;
use District09\BackupManager\Tasks\Task;
use League\Flysystem\FilesystemException;

/**
 * Class TransferFile
 * @package District09\BackupManager\Tasks\Storage
 */
class TransferFile implements Task
{
    /** @var Filesystem */
    private $sourceFilesystem;
    /** @var string */
    private $sourcePath;
    /** @var Filesystem */
    private $destinationFilesystem;
    /** @var string */
    private $destinationPath;

    /**
     * @param Filesystem $sourceFilesystem
     * @param string $sourcePath
     * @param Filesystem $destinationFilesystem
     * @param string $destinationPath
     */
    public function __construct(Filesystem $sourceFilesystem, $sourcePath, Filesystem $destinationFilesystem, $destinationPath)
    {
        $this->sourceFilesystem = $sourceFilesystem;
        $this->sourcePath = $sourcePath;
        $this->destinationFilesystem = $destinationFilesystem;
        $this->destinationPath = $destinationPath;
    }

    /**
     * @throws FilesystemException
     */
    public function execute()
    {
        $this->destinationFilesystem->writeStream(
            $this->destinationPath,
            $this->sourceFilesystem->readStream($this->sourcePath)
        );
    }
}
