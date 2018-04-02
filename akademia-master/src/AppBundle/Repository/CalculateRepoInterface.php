<?php
/**
 * Created by PhpStorm.
 * User: bartek
 * Date: 25.03.17
 * Time: 09:43
 */

namespace AppBundle\Repository;


use AppBundle\Entity\CalculateResult;

/**
 * Interface CalculateRepoInterface
 * @package AppBundle\Repository
 */
interface CalculateRepoInterface {

    /**
     * @param CalculateResult $calculateResult
     * @return CalculateResult
     */
    public function save(CalculateResult $calculateResult);

    /**
     * @param $id
     * @return CalculateResult
     */
    public function findById($id);
}