<?php namespace District09\BackupManager\Procedures;

use District09\BackupManager\Compressors\CompressorTypeNotSupported;
use District09\BackupManager\Config\ConfigFieldNotFound;
use District09\BackupManager\Config\ConfigNotFoundForConnection;
use District09\BackupManager\Databases\DatabaseTypeNotSupported;
use District09\BackupManager\Filesystems\Destination;
use District09\BackupManager\Filesystems\FilesystemTypeNotSupported;
use District09\BackupManager\Tasks;

/**
 * Class BackupProcedure
 * @package District09\BackupManager\Procedures
 */
class BackupProcedure extends Procedure
{
    /**
     * @param string $database
     * @param Destination[] $destinations
     * @param string $compression
     * @throws FilesystemTypeNotSupported
     * @throws ConfigFieldNotFound
     * @throws CompressorTypeNotSupported
     * @throws DatabaseTypeNotSupported
     * @throws ConfigNotFoundForConnection
     */
    public function run($database, array $destinations, $compression)
    {
        $sequence = new Sequence;

        // begin the life of a new working file
        $localFilesystem = $this->filesystems->get('local');
        $workingFile = $this->getWorkingFile('local');

        // dump the database
        $sequence->add(new Tasks\Database\DumpDatabase(
            $this->databases->get($database),
            $workingFile,
            $this->shellProcessor
        ));

        // archive the dump
        $compressor = $this->compressors->get($compression);
        $sequence->add(new Tasks\Compression\CompressFile(
            $compressor,
            $workingFile,
            $this->shellProcessor
        ));
        $workingFile = $compressor->getCompressedPath($workingFile);

        // upload the archive
        foreach ($destinations as $destination) {
            $sequence->add(new Tasks\Storage\TransferFile(
                $localFilesystem,
                basename($workingFile),
                $this->filesystems->get($destination->destinationFilesystem()),
                $compressor->getCompressedPath($destination->destinationPath())
            ));
        }

        // cleanup the local archive
        $sequence->add(new Tasks\Storage\DeleteFile(
            $localFilesystem,
            basename($workingFile)
        ));

        $sequence->execute();
    }
}
