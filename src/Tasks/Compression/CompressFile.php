<?php namespace District09\BackupManager\Tasks\Compression;

use Symfony\Component\Process\Process;
use District09\BackupManager\ShellProcessing\ShellProcessFailed;
use District09\BackupManager\Tasks\Task;
use District09\BackupManager\Compressors\Compressor;
use District09\BackupManager\ShellProcessing\ShellProcessor;

/**
 * Class CompressFile
 * @package District09\BackupManager\Tasks\Compression
 */
class CompressFile implements Task
{
    /** @var string */
    private $sourcePath;
    /** @var ShellProcessor */
    private $shellProcessor;
    /** @var Compressor */
    private $compressor;

    /**
     * @param Compressor $compressor
     * @param string $sourcePath
     * @param ShellProcessor $shellProcessor
     */
    public function __construct(Compressor $compressor, $sourcePath, ShellProcessor $shellProcessor)
    {
        $this->compressor = $compressor;
        $this->sourcePath = $sourcePath;
        $this->shellProcessor = $shellProcessor;
    }

    /**
     * @throws ShellProcessFailed
     */
    public function execute()
    {
        return $this->shellProcessor->process(
            Process::fromShellCommandline(
                $this->compressor->getCompressCommandLine($this->sourcePath)
            )
        );
    }
}
