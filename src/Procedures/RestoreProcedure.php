<?php namespace District09\BackupManager\Procedures;

use District09\BackupManager\Compressors\CompressorTypeNotSupported;
use District09\BackupManager\Config\ConfigFieldNotFound;
use District09\BackupManager\Config\ConfigNotFoundForConnection;
use District09\BackupManager\Databases\DatabaseTypeNotSupported;
use District09\BackupManager\Filesystems\FilesystemTypeNotSupported;
use District09\BackupManager\Tasks;

/**
 * Class RestoreProcedure
 * @package District09\BackupManager\Procedures
 */
class RestoreProcedure extends Procedure
{
    /**
     * @param string $sourceType
     * @param string $sourcePath
     * @param string $databaseName
     * @param string|null $compression
     * @throws FilesystemTypeNotSupported
     * @throws ConfigFieldNotFound
     * @throws CompressorTypeNotSupported
     * @throws DatabaseTypeNotSupported
     * @throws ConfigNotFoundForConnection
     */
    public function run($sourceType, $sourcePath, $databaseName, $compression = null)
    {
        $sequence = new Sequence;

        // begin the life of a new working file
        $localFilesystem = $this->filesystems->get('local');
        $workingFile = $this->getWorkingFile('local', uniqid() . basename($sourcePath));

        // download or retrieve the archived backup file
        $sequence->add(new Tasks\Storage\TransferFile(
            $this->filesystems->get($sourceType),
            $sourcePath,
            $localFilesystem,
            basename($workingFile)
        ));

        // decompress the archived backup
        $compressor = $this->compressors->get($compression);
        $sequence->add(new Tasks\Compression\DecompressFile(
            $compressor,
            $workingFile,
            $this->shellProcessor
        ));
        $workingFile = $compressor->getDecompressedPath($workingFile);

        // restore the database
        $sequence->add(new Tasks\Database\RestoreDatabase(
            $this->databases->get($databaseName),
            $workingFile,
            $this->shellProcessor
        ));

        // cleanup the local copy
        $sequence->add(new Tasks\Storage\DeleteFile(
            $localFilesystem,
            basename($workingFile)
        ));

        $sequence->execute();
    }
}
