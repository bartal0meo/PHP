<?php
namespace AppBundle\Service;
use AppBundle\Repository\CalculateRepoInterface;

/**
 * Created by PhpStorm.
 * User: bartek
 * Date: 25.03.17
 * Time: 10:52
 */


class CalculateService{


    private $calucalate;

    public function __construct(CalculateRepoInterface $calculateRepo)
    {
        $this->calucalate = $calculateRepo;
    }

}