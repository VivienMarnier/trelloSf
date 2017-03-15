<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 15:47
 */

namespace AppBundle\Manager;


use AppBundle\Entity\Category;

class CategoryManager
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
    public function getCategories()
    {
        return $this->getRepository()->getCategories();
    }
    private function getRepository()
    {
        return $this->doctrineManager->getRepository(Category::class);
    }
}