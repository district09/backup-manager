<?php namespace District09\BackupManager\Databases;

use District09\BackupManager\Config\Config;
use District09\BackupManager\Config\ConfigNotFoundForConnection;

/**
 * Class DatabaseProvider
 * @package District09\BackupManager\Databases
 */
class DatabaseProvider
{
    /** @var Config */
    private $config;
    /** @var array */
    private $databases = [];

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param Database $database
     */
    public function add(Database $database)
    {
        $this->databases[] = $database;
    }

    /**
     * @param string $name
     * @return Database
     * @throws DatabaseTypeNotSupported
     * @throws ConfigNotFoundForConnection
     * @throws \District09\BackupManager\Config\ConfigFieldNotFound
     */
    public function get($name)
    {
        $type = $this->config->get($name, 'type');
        foreach ($this->databases as $database) {
            if ($database->handles($type)) {
                $database->setConfig($this->config->get($name));
                return $database;
            }
        }
        throw new DatabaseTypeNotSupported("The requested database type {$type} is not currently supported.");
    }

    /**
     * @return array
     */
    public function getAvailableProviders()
    {
        return array_keys($this->config->getItems());
    }
}
