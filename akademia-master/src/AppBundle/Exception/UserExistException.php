<?php
/**
 * Created by PhpStorm.
 * User: bartek
 * Date: 13.05.17
 * Time: 09:56
 */

namespace AppBundle\Exception;


use Throwable;

class UserExistException extends \Exception{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->addLog();
    }

    private function addLog()
    {
        //save to file monolog
    }

}