<?php
/**
 * Created by PhpStorm.
 * User: mariusz
 * Date: 18.03.17
 * Time: 09:59
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "calculate_results")
 */
class CalculateResult{
    /**
     * @var string
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


}