<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 15.05.17
 * Time: 13:38
 */

namespace AppBundle\Entity;


use Doctrine\ORM\EntityRepository;

class RecipesRepository extends EntityRepository
{
    public function findmydisplay()
    {
        $query=$this->getEntityManager()->createQuery('SELECT p FROM AppBundle:Recipes p WHERE p.mydisplay = 1');
        $users=$query->getResult();
        return $users;
        //return $this->getEntityManager()->createQuery('SELECT p FROM AppBundle:Recipes WHERE p.mydisplay = 1')->getResult();
    }

}