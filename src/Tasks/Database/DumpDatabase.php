<?php namespace District09\BackupManager\Tasks\Database;

use District09\BackupManager\Tasks\Task;
use District09\BackupManager\Databases\Database;
use Symfony\Component\Process\Process;
use District09\BackupManager\ShellProcessing\ShellProcessor;
use District09\BackupManager\ShellProcessing\ShellProcessFailed;

/**
 * Class DumpDatabase
 * @package District09\BackupManager\Tasks\Database\Mysql
 */
class DumpDatabase implements Task
{
    /** @var string */
    private $outputPath;
    /** @var ShellProcessor */
    private $shellProcessor;
    /** @var Database */
    private $database;

    /**
     * @param Database $database
     * @param string $outputPath
     * @param ShellProcessor $shellProcessor
     */
    public function __construct(Database $database, $outputPath, ShellProcessor $shellProcessor)
    {
        $this->outputPath = $outputPath;
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
                $this->database->getDumpCommandLine($this->outputPath)
            )
        );
    }
}
