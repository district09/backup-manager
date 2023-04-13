<?php namespace District09\BackupManager\Compressors;

/**
 * Class NullCompressor
 * @package District09\BackupManager\Compressors
 */
class NullCompressor implements Compressor
{
    /**
     * @param string|null $type
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
