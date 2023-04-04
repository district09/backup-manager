<?php namespace BackupManager\Databases;

/**
 * Class Database
 * @package BackupManager\Databases
 */
interface Database
{
    /**
     * @param string $type
     * @return bool
     */
    public function handles($type);

    /**
     * @param array $config
     * @return void
     */
    public function setConfig(array $config);

    /**
     * @param string $inputPath
     * @return string
     */
    public function getDumpCommandLine($inputPath);

    /**
     * @param string $outputPath
     * @return string
     */
    public function getRestoreCommandLine($outputPath);
}
