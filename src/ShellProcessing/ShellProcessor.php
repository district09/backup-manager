<?php namespace BigName\DatabaseBackup\ShellProcessing;

use Symfony\Component\Process\Process;

/**
 * Class CommandProcessor
 * @package BigName\DatabaseBackup
 */
class ShellProcessor
{
    /**
     * @var \Symfony\Component\Process\Process
     */
    private $process;

    /**
     * @param Process $process
     */
    public function __construct(Process $process)
    {
        $this->process = $process;
    }

    public function process($command)
    {
        if (empty($command)) {
            return;
        }

        $this->process->setCommandLine($command);
        $this->process->run();
        if ( ! $this->process->isSuccessful()) {
            throw new ShellProcessFailed($this->process->getErrorOutput());
        }
    }
}
