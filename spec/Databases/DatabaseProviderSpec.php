<?php

namespace spec\District09\BackupManager\Databases;

use District09\BackupManager\Config\Config;
use District09\BackupManager\Databases\MysqlDatabase;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DatabaseProviderSpec extends ObjectBehavior
{
    public function let()
    {
        /** @noinspection PhpParamsInspection */
        $this->beConstructedWith(Config::fromPhpFile('spec/configs/database.php'));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('District09\BackupManager\Databases\DatabaseProvider');
    }

    public function it_should_provide_requested_databases_by_name()
    {
        $this->add(new MysqlDatabase);
        $this->get('development')->shouldHaveType('District09\BackupManager\Databases\MysqlDatabase');
    }

    public function it_should_throw_an_exception_if_a_database_is_unsupported()
    {
        $this->shouldThrow('District09\BackupManager\Databases\DatabaseTypeNotSupported')->during('get', ['unsupported']);
    }

    public function it_should_provide_a_list_of_available_databases()
    {
        $this->getAvailableProviders()->shouldBe(['development', 'developmentSingleTrans', 'production', 'unsupported', 'null']);
    }
}
