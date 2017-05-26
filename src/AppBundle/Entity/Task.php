<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 23.05.17
 * Time: 12:12
 */

namespace AppBundle\Entity;


class Task
{
    protected $task;

    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

}