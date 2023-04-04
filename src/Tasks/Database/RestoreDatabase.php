<?php namespace District09\BackupManager\Tasks\Database;

use District09\BackupManager\Tasks\Task;
use District09\BackupManager\Databases\Database;
use Symfony\Component\Process\Process;
use District09\BackupManager\ShellProcessing\ShellProcessor;
use District09\BackupManager\ShellProcessing\ShellProcessFailed;

/**
 * Class RestoreDatabase
 * @package District09\BackupManager\Tasks\Database
 */
class RestoreDatabase implements Task
{
    /** @var string */
    private $inputPath;
    /** @var ShellProcessor */
    private $shellProcessor;
    /** @var Database */
    private $database;

    /**
     * @param Database $database
     * @param string $inputPath
     * @param ShellProcessor $shellProcessor
     */
    public function __construct(Database $database, $inputPath, ShellProcessor $shellProcessor)
    {
        $this->inputPath = $inputPath;
        $this->shellProcessor = $shellProcessor;
        $this->database = $database;
    }

    /**
     * @throws ShellProcessFailed
     */
    public function execute()
    {
        return $this->shellProcessor->process(
            Process::fromShellCommandline(
                $this->database->getRestoreCommandLine($this->inputPath)
            )
        );
    }
}
