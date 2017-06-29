<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 28.06.17
 * Time: 23:25
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="adres")
 */
class Adress
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     *
     */
    private $streetname;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="integer")
     */
    private $number;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set streetname
     *
     * @param string $streetname
     *
     * @return Adress
     */
    public function setStreetname($streetname)
    {
        $this->streetname = $streetname;

        return $this;
    }

    /**
     * Get streetname
     *
     * @return string
     */
    public function getStreetname()
    {
        return $this->streetname;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Adress
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }
}
