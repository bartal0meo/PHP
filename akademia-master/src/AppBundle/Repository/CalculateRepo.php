<?php
/**
 * Created by PhpStorm.
 * User: bartek
 * Date: 25.03.17
 * Time: 09:43
 */

namespace AppBundle\Repository;

use AppBundle\Entity\CalculateResult;
use Doctrine\ORM\EntityRepository;

class CalculateRepo extends EntityRepository implements CalculateRepoInterface {

    /**
     * @param CalculateResult $calculateResult
     * @return CalculateResult
     */
    public function save(CalculateResult $calculateResult)
    {
       $this->getEntityManager()->persist($calculateResult);
       $this->getEntityManager()->flush();
    }

    /**
     * @param $id
     * @return CalculateResult
     */
    public function findById($id)
    {
       return $this->findById($id);
    }
}