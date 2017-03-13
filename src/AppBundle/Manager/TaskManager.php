<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 15:47
 */

namespace AppBundle\Manager;


use AppBundle\Entity\Task;

class TaskManager
{
    private $doctrineManager;

    /**
     * CategoryManager constructor.
     * @param $doctrineManager
     */
    public function __construct($doctrineManager)
    {
        $this->doctrineManager = $doctrineManager;
    }
    public function create()
    {
        return new Task();
    }
    public function save(Task $task)
    {
        if($task->getId() === null)
        {
            $this->doctrineManager->persist($task);
        }
        $this->doctrineManager->flush();
    }
    private function getRepository()
    {
        return $this->doctrineManager->getRepository(Task::class);
    }
}