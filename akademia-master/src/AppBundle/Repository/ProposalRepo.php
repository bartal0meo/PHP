<?php
/**
 * Created by PhpStorm.
 * User: bartek
 * Date: 25.03.17
 * Time: 09:43
 */

namespace AppBundle\Repository;

use AppBundle\Entity\CalculateResult;
use AppBundle\Entity\Proposal;

use Doctrine\ORM\EntityRepository;

class ProposalRepo extends EntityRepository {


    /**
     * @param $id
     * @return Proposal
     */
    public function findById($id)
    {
        return $this->_em->find('AppBundle\Entity\Proposal', $id);

    }
    public function findPropsal(){
        return $this->_em->find("AppBundle\Entity\Proposal",1);
    }

}