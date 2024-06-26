<?php

namespace District09\BackupManager;

use District09\BackupManager\Procedures;
use Symfony\Component\Process\Process;
use District09\BackupManager\Databases\DatabaseProvider;
use District09\BackupManager\Filesystems\FilesystemProvider;
use District09\BackupManager\Compressors\CompressorProvider;
use District09\BackupManager\ShellProcessing\ShellProcessor;

/**
 * Class Manager
 *
 * This is a facade class that gives consumers access to the simple backup and restore procedures.
 * This class can be copied and namespaced into your project, renamed, added to, modified, etc.
 * Once you've done that, your application can interact with the backup manager in one place only
 * and the rest of the system will interact with the new Manager-like construct that you created.
 *
 * @package BackupManager
 */
class Manager
{
    /** @var FilesystemProvider */
    private $filesystems;
    /** @var DatabaseProvider */
    private $databases;
    /** @var CompressorProvider */
    private $compressors;

    /**
     * @param FilesystemProvider $filesystems
     * @param DatabaseProvider $databases
     * @param CompressorProvider $compressors
     */
    public function __construct(FilesystemProvider $filesystems, DatabaseProvider $databases, CompressorProvider $compressors)
    {
        $this->filesystems = $filesystems;
        $this->databases = $databases;
        $this->compressors = $compressors;
    }

    /**
     * @return Procedures\BackupProcedure
     */
    public function makeBackup()
    {
        return new Procedures\BackupProcedure(
            $this->filesystems,
            $this->databases,
            $this->compressors,
            $this->getShellProcessor()
        );
    }

    /**
     * @return Procedures\RestoreProcedure
     */
    public function makeRestore()
    {
        return new Procedures\RestoreProcedure(
            $this->filesystems,
            $this->databases,
            $this->compressors,
            $this->getShellProcessor()
        );
    }

    /**
     * @return ShellProcessing\ShellProcessor
     */
    protected function getShellProcessor()
    {
        return new ShellProcessor();
    }
}
