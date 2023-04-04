<?php namespace BackupManager\Compressors;

/**
 * Interface Compressor
 * @package BackupManager\Compressors
 */
interface Compressor
{
    /**
     * @param string $type
     * @return bool
     */
    public function handles($type);

    /**
     * @param string $inputPath
     * @return string
     */
    public function getCompressCommandLine($inputPath);

    /**
     * @param string $outputPath
     * @return string
     */
    public function getDecompressCommandLine($outputPath);

    /**
     * @param string $inputPath
     * @return string
     */
    public function getCompressedPath($inputPath);

    /**
     * @param string $inputPath
     * @return string
     */
    public function getDecompressedPath($inputPath);
}
