<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 15:01
 */

namespace AppBundle\DatasFixtures\ORM;

use AppBundle\Entity\Task;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadTaskData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $taskData = array(
            array(
                'name' => 'Gestion utilisateurs',
                'description' => 'Pouvoir gérer les utilisateurs avec FOSUserBundle',
                'status' => 'open',
            ),
            array(
                'name' => 'Gestion des Categories',
                'description' => 'Pouvoir gérer les catégories (CRUD)',
                'status' => 'open',
            ),
            array(
                'name' => 'Gestion des Tâches',
                'description' => 'Pouvoir gérer les tâches (CRUD)',
                'status' => 'open',
            ),
            array(
                'name' => 'Intégration HTML / CSS',
                'description' => 'Réaliser l\'intégration HTML / CSS des pages du site',
                'status' => 'open',
            ),
        );
        foreach ($taskData as $i => $taskA) {
            $task = new Task();
            $task->setName($taskA['name']);
            $task->setDescription($taskA['description']);
            $task->setStatus($taskA['status']);
            $task->setCategory($this->getReference('category-0'));
            $manager->persist($task);
            $this->addReference('task-'.$i, $task);
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 20;
    }
}