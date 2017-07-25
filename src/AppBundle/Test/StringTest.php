<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 29.06.17
 * Time: 13:00
 */

namespace AppBundle\Test;

use PHPUnit\Framework\TestCase;

class StringTest extends TestCase
{
    /**
     * @var String
     */
    protected $object;
    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->object=new MyString("Coś tam");
    }

    public function testToString()
    {
    $this->assertEquals("Coś tam",(string)$this->object);
    }
    public function testStrToLower()
    {
        $text=new MyString("ŻóŁĆ");
        $text2=new MyString("PięŚĆ");
        $this->assertEquals("żółć",$text->toLower());
        $this->assertEquals("pięść",$text2=$text2->toLower());
        $this->assertSame("pięść",$text2);
    }
    public function testSubString()
    {
        $text=new MyString("Jakiś tam sobie tekst");
        $od=2;
        $do=-3;
        $this->assertEquals("kiś tam sobie te",$text=$text->substring($od,$do));
        $this->assertNotNull($text);
        $this->assertNotSame("Jakiś tam sobie tekst",$text);
    }
    public function testTrim()
    {
        $text=new MyString("    Jakiś tam sobie tekst   ");
        $this->assertEquals("Jakiś tam sobie tekst",$text2=$text->trim());
        $this->assertGreaterThan($text,$text2);
    }
}