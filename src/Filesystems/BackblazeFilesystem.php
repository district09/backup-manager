<?php namespace District09\BackupManager\Filesystems;

use BackblazeB2\Client;
use League\Flysystem\Filesystem as Flysystem;
use MarcAndreAppel\FlysystemBackblaze\BackblazeAdapter;

/**
 * Class BackblazeFilesystem
 * @package District09\BackupManager\Filesystems
 */
class BackblazeFilesystem implements Filesystem
{
    /**
     * Test fitness of visitor.
     * @param string|null $type
     * @return bool
     */
    public function handles($type)
    {
        return strtolower($type ?? '') == 'b2';
    }

    /**
     * @param array $config
     * @return Flysystem
     * @throws \Exception
     */
    public function get(array $config)
    {
        if (!isset($config['options'])) {
            $config['options'] = [];
        }

        $client = new Client($config['accountId'], $config['key'], $config['options']);
        return new Flysystem(new BackblazeAdapter($client, $config['bucket']));
    }
}
