<?php namespace District09\BackupManager\Procedures;

use District09\BackupManager\Tasks\Task;

/**
 * Class Sequence
 * @package District09\BackupManager\Procedures
 */
class Sequence
{
    /** @var array|Task[] */
    private $tasks = [];

    /**
     * @param Task $task
     */
    public function add(Task $task)
    {
        $this->tasks[] = $task;
    }

    /**
     * Run the procedure.
     * @return void
     */
    public function execute()
    {
        foreach ($this->tasks as $task) {
            $task->execute();
        }
    }
}
