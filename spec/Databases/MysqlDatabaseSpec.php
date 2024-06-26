<?php

namespace spec\District09\BackupManager\Databases;

use District09\BackupManager\Config\Config;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MysqlDatabaseSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('District09\BackupManager\Databases\MysqlDatabase');
    }

    public function it_should_recognize_its_type_with_case_insensitivity()
    {
        foreach (['mysql', 'MYsql', 'MYSQL'] as $type) {
            $this->handles($type)->shouldBe(true);
        }

        foreach ([null, 'foo'] as $type) {
            $this->handles($type)->shouldBe(false);
        }
    }

    public function it_should_generate_a_valid_database_dump_command()
    {
        $this->configure();
        $this->getDumpCommandLine('outputPath')->shouldBe("mysqldump --routines  --host='foo' --port='3306' --user='bar' --password='baz' 'test' > 'outputPath'");
    }

    public function it_should_generate_a_valid_database_dump_command_with_single_transaction()
    {
        $this->configure('developmentSingleTrans');
        $this->getDumpCommandLine('outputPath')->shouldBe("mysqldump --routines --single-transaction --host='foo' --port='3306' --user='bar' --password='baz' 'test' > 'outputPath'");
    }

    public function it_should_generate_a_valid_database_restore_command()
    {
        $this->configure();
        $this->getRestoreCommandLine('outputPath')->shouldBe("mysql --host='foo' --port='3306' --user='bar' --password='baz'  'test' -e \"source outputPath\"");
    }

    private function configure($db = 'development')
    {
        $config = Config::fromPhpFile('spec/configs/database.php');
        $this->setConfig($config->get($db));
    }
}
