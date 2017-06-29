<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 29.06.17
 * Time: 10:18
 */

namespace AppBundle\Test;


class TestString
{
    private $text;
    function __construct($text)
    {
        $this->text=$text;
    }
    function something()
    {
       $trimmed=trim($this->text);
       return $trimmed;
    }
    function something2()
    {
        $subst=substr($this->text,0,-1);
        return $subst;
    }

}