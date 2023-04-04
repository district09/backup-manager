<?php namespace BackupManager\Compressors;

/**
 * Class NullCompressor
 * @package BackupManager\Compressors
 */
class NullCompressor implements Compressor
{
    /**
     * @param string $type
     * @return bool
     */
    public function handles($type)
    {
        return strtolower($type ?? '') == 'null';
    }

    /**
     * @param string $inputPath
     * @return string
     */
    public function getCompressCommandLine($inputPath)
    {
        return '';
    }

    /**
     * @param string $outputPath
     * @return string
     */
    public function getDecompressCommandLine($outputPath)
    {
        return '';
    }

    /**
     * @param string $inputPath
     * @return string
     */
    public function getCompressedPath($inputPath)
    {
        return $inputPath;
    }

    /**
     * @param string $inputPath
     * @return string
     */
    public function getDecompressedPath($inputPath)
    {
        return $inputPath;
    }
}
