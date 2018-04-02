<?php
/**
 * Created by PhpStorm.
 * User: mariusz
 * Date: 04.03.17
 * Time: 09:48
 */

namespace AppBundle\Entity;

class PageInfoShow extends PageInfoAbstract implements PageInfoInterface {

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}