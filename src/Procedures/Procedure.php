<?php namespace District09\BackupManager\Procedures;

use District09\BackupManager\Config\ConfigFieldNotFound;
use District09\BackupManager\Config\ConfigNotFoundForConnection;
use District09\BackupManager\Databases\DatabaseProvider;
use District09\BackupManager\Compressors\CompressorProvider;
use District09\BackupManager\Filesystems\FilesystemProvider;
use District09\BackupManager\ShellProcessing\ShellProcessor;

/**
 * Class Procedure
 * @package Procedures
 */
abstract class Procedure
{
    /** @var FilesystemProvider */
    protected $filesystems;
    /** @var DatabaseProvider */
    protected $databases;
    /** @var CompressorProvider */
    protected $compressors;
    /** @var ShellProcessor */
    protected $shellProcessor;

    /**
     * @param FilesystemProvider $filesystemProvider
     * @param DatabaseProvider $databaseProvider
     * @param CompressorProvider $compressorProvider
     * @param ShellProcessor $shellProcessor
     * @internal param Sequence $sequence
     */
    public function __construct(FilesystemProvider $filesystemProvider, DatabaseProvider $databaseProvider, CompressorProvider $compressorProvider, ShellProcessor $shellProcessor)
    {
        $this->filesystems = $filesystemProvider;
        $this->databases = $databaseProvider;
        $this->compressors = $compressorProvider;
        $this->shellProcessor = $shellProcessor;
    }

    /**
     * @param string $name
     * @param null|string $filename
     * @return string
     * @throws ConfigNotFoundForConnection
     * @throws ConfigFieldNotFound
     */
    protected function getWorkingFile($name, $filename = null)
    {
        if (is_null($filename)) {
            $filename = uniqid();
        }
        return sprintf('%s/%s', $this->getRootPath($name), $filename);
    }

    /**
     * @param string $name
     * @return string
     * @throws ConfigNotFoundForConnection
     * @throws ConfigFieldNotFound
     */
    protected function getRootPath($name)
    {
        $path = $this->filesystems->getConfig($name, 'root');
        return preg_replace('/\/$/', '', $path);
    }
}
