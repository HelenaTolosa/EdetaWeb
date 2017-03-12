<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Epoca
 *
 * @ORM\Table(name="epoca")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EpocaRepository")
 */
class Epoca
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
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Yacimiento", mappedBy="epoca", cascade={"persist", "remove"})
     */
    protected $yacimientos;

    public function __toString() {

        return $this->nombre;
    }

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
     * Set nombre
     *
     * @param string $nombre
     * @return Epoca
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->yacimientos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add yacimientos
     *
     * @param \AppBundle\Entity\Yacimiento $yacimientos
     * @return Epoca
     */
    public function addYacimiento(\AppBundle\Entity\Yacimiento $yacimientos)
    {
        $this->yacimientos[] = $yacimientos;

        return $this;
    }

    /**
     * Remove yacimientos
     *
     * @param \AppBundle\Entity\Yacimiento $yacimientos
     */
    public function removeYacimiento(\AppBundle\Entity\Yacimiento $yacimientos)
    {
        $this->yacimientos->removeElement($yacimientos);
    }

    /**
     * Get yacimientos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getYacimientos()
    {
        return $this->yacimientos;
    }
}
