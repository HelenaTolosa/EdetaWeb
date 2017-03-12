<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Provincia;

/**
 * Municipio
 *
 * @ORM\Table(name="municipio")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MunicipioRepository")
 */
class Municipio
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
     * @ORM\Column(name="nommunicipio", type="string", length=255, unique=true)
     */
    private $nommunicipio;

    /**
     * @ORM\ManyToOne(targetEntity="Provincia", inversedBy="municipios")
     * @ORM\JoinColumn(name="provincia_id", referencedColumnName="id", nullable=false)
     */
    protected $provincia;
    

    public function __toString() {

        return $this->nommunicipio;
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
     * Set nommunicipio
     *
     * @param string $nommunicipio
     * @return Municipio
     */
    public function setNommunicipio($nommunicipio)
    {
        $this->nommunicipio = $nommunicipio;

        return $this;
    }

    /**
     * Get nommunicipio
     *
     * @return string 
     */
    public function getNommunicipio()
    {
        return $this->nommunicipio;
    }

    /**
     * Set provincia
     *
     * @param \AppBundle\Entity\Provincia $provincia
     * @return Municipio
     */
    public function setProvincia(\AppBundle\Entity\Provincia $provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \AppBundle\Entity\Provincia 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
}
