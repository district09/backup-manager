<?php namespace District09\BackupManager\Filesystems;

use District09\BackupManager\Config\Config;
use District09\BackupManager\Config\ConfigFieldNotFound;
use District09\BackupManager\Config\ConfigNotFoundForConnection;

/**
 * Class FilesystemProvider
 * @package District09\BackupManager\Filesystems
 */
class FilesystemProvider
{
    /** @var Config */
    private $config;
    /** @var array */
    private $filesystems = [];

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param Filesystem $filesystem
     */
    public function add(Filesystem $filesystem)
    {
        $this->filesystems[] = $filesystem;
    }

    /**
     * @param string $name
     * @return \League\Flysystem\Filesystem
     * @throws FilesystemTypeNotSupported
     * @throws ConfigNotFoundForConnection
     * @throws ConfigFieldNotFound
     */
    public function get($name)
    {
        $type = $this->getConfig($name, 'type');

        foreach ($this->filesystems as $filesystem) {
            if ($filesystem->handles($type)) {
                return $filesystem->get($this->config->get($name));
            }
        }

        throw new FilesystemTypeNotSupported("The requested filesystem type {$type} is not currently supported.");
    }

    /**
     * @param string $name
     * @param null|string $key
     * @return mixed
     * @throws ConfigNotFoundForConnection
     * @throws ConfigFieldNotFound
     */
    public function getConfig($name, $key = null)
    {
        return $this->config->get($name, $key);
    }

    /**
     * @return array
     */
    public function getAvailableProviders()
    {
        return array_keys($this->config->getItems());
    }
}
