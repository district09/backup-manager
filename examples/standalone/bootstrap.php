<?php

// path to composer autoloader
require '../../vendor/autoload.php';

use District09\BackupManager\Config\Config;
use District09\BackupManager\Filesystems;
use District09\BackupManager\Databases;
use District09\BackupManager\Compressors;
use District09\BackupManager\Manager;

// build providers
$filesystems = new Filesystems\FilesystemProvider(Config::fromPhpFile('config/storage.php'));
$filesystems->add(new Filesystems\Awss3Filesystem);
$filesystems->add(new Filesystems\GcsFilesystem);
$filesystems->add(new Filesystems\DropboxFilesystem);
$filesystems->add(new Filesystems\FtpFilesystem);
$filesystems->add(new Filesystems\LocalFilesystem);
$filesystems->add(new Filesystems\RackspaceFilesystem);
$filesystems->add(new Filesystems\SftpFilesystem);
$filesystems->add(new Filesystems\WebdavFilesystem);

$databases = new Databases\DatabaseProvider(Config::fromPhpFile('config/database.php'));
$databases->add(new Databases\MysqlDatabase);
$databases->add(new Databases\PostgresqlDatabase);

$compressors = new Compressors\CompressorProvider;
$compressors->add(new Compressors\GzipCompressor);
$compressors->add(new Compressors\NullCompressor);

// build manager
return new Manager($filesystems, $databases, $compressors);
