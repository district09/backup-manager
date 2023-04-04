<?php namespace BackupManager\Compressors;

/**
 * Class GzipCompressor
 * @package BackupManager\Compressors
 */
class GzipCompressor implements Compressor
{
    /**
     * @param string $type
     * @return bool
     */
    public function handles($type)
    {
        return strtolower($type ?? '') == 'gzip';
    }

    /**
     * @param string $inputPath
     * @return string
     */
    public function getCompressCommandLine($inputPath)
    {
        return 'gzip ' . escapeshellarg($inputPath);
    }

    /**
     * @param string $outputPath
     * @return string
     */
    public function getDecompressCommandLine($outputPath)
    {
        return 'gzip -d ' . escapeshellarg($outputPath);
    }

    /**
     * @param string $inputPath
     * @return string
     */
    public function getCompressedPath($inputPath)
    {
        return $inputPath . '.gz';
    }

    /**
     * @param string $inputPath
     * @return string
     */
    public function getDecompressedPath($inputPath)
    {
        return preg_replace('/\.gz$/', '', $inputPath);
    }
}
