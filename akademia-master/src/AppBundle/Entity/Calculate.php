<?php
/**
 * Created by PhpStorm.
 * User: bartek
 * Date: 11.03.17
 * Time: 09:32
 */

namespace AppBundle\Entity;

class Calculate{

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 10,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $liczba1;
    private $liczba2;

    public function saveDb()
    {
    }


}