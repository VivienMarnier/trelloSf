<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 15:41
 */

namespace AppBundle\Repository;

/**
 * CategoryRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends \Doctrine\ORM\EntityRepository
{
    public function getCategories()
    {
        return $this->createQueryBuilder('c')
            ->select('c')
            ->getQuery()
            ->getResult();
    }
}