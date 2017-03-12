<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Provincia
 *
 * @ORM\Table(name="provincia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProvinciaRepository")
 */
class Provincia
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
     * @ORM\OneToMany(targetEntity="Municipio", mappedBy="Provincia", cascade={"persist", "remove"})
     */
    protected $munis;
    

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
     * @return Provincia
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
        $this->munis = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add munis
     *
     * @param \AppBundle\Entity\Municipio $munis
     * @return Provincia
     */
    public function addMuni(\AppBundle\Entity\Municipio $munis)
    {
        $this->munis[] = $munis;

        return $this;
    }

    /**
     * Remove munis
     *
     * @param \AppBundle\Entity\Municipio $munis
     */
    public function removeMuni(\AppBundle\Entity\Municipio $munis)
    {
        $this->munis->removeElement($munis);
    }

    /**
     * Get munis
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMunis()
    {
        return $this->munis;
    }
}
