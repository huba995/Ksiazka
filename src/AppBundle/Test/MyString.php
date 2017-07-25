<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 29.06.17
 * Time: 10:18
 */

namespace AppBundle\Test;


class MyString
{
    private $text;
    function __construct($text)
    {
        $this->text=$text;
    }
    function trim()
    {
       $trimmed=trim($this->text);
       return $trimmed;
    }
    function substring($od,$do)
    {
        $subst=substr($this->text,$od,$do);
        return $subst;
    }

    function __toString()
    {
        return $this->text;
        // TODO: Implement __toString() method.
    }
    function toLower()
    {
        $textlower=mb_strtolower($this->text,"UTF-8");
        return $textlower;
    }

}