<?php
/**
 * Created by PhpStorm.
 * User: bartek
 * Date: 04.03.17
 * Time: 10:53
 */

namespace AppBundle\Entity;


abstract class PageInfoAbstract implements PageInfoInterface {

    protected $title;
    protected $description;


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }


}