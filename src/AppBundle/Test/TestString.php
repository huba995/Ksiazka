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
    function FunctionTrim()
    {
       trim($text);
    }


}