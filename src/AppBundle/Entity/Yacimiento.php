<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Municipio;
use AppBundle\Entity\Arqueologo;
use AppBundle\Entity\Epoca;

/**
 * Yacimiento
 *
 * @ORM\Table(name="yacimiento")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\YacimientoRepository")
 */
class Yacimiento
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
     * @ORM\Column(name="nombreYac", type="string", length=255)
     */
    private $nombreYac;

    /**
     * @var string
     *
     * @ORM\Column(name="expediente", type="string", length=255, unique=true)
     */
    private $expediente;

    /**
     * @ORM\ManyToOne(targetEntity="Epoca", inversedBy="yacimientos")
     * @ORM\JoinColumn(name="epoca_id", referencedColumnName="id", nullable=false)
     */
    protected $epoca;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaExca", type="date")
     */
    private $fechaExca;

    /**
     * @var string
     *
     * @ORM\Column(name="coordenadas", type="string", length=255, unique=true)
     */
    private $coordenadas;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Municipio", inversedBy="yacimientos")
     * @ORM\JoinColumn(name="municipio_id", referencedColumnName="id", nullable=false)
     */
    protected $municipio;

    /**
     * @ORM\ManyToOne(targetEntity="Arqueologo", inversedBy="yacimientos")
     * @ORM\JoinColumn(name="arqueologo_id", referencedColumnName="id", nullable=false)
     */
    protected $arqueologo;


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
     * Set nombreYac
     *
     * @param string $nombreYac
     * @return Yacimiento
     */
    public function setNombreYac($nombreYac)
    {
        $this->nombreYac = $nombreYac;

        return $this;
    }

    /**
     * Get nombreYac
     *
     * @return string 
     */
    public function getNombreYac()
    {
        return $this->nombreYac;
    }

    /**
     * Set expediente
     *
     * @param string $expediente
     * @return Yacimiento
     */
    public function setExpediente($expediente)
    {
        $this->expediente = $expediente;

        return $this;
    }

    /**
     * Get expediente
     *
     * @return string 
     */
    public function getExpediente()
    {
        return $this->expediente;
    }

    /**
     * Set fechaExca
     *
     * @param \DateTime $fechaExca
     * @return Yacimiento
     */
    public function setFechaExca($fechaExca)
    {
        $this->fechaExca = $fechaExca;

        return $this;
    }

    /**
     * Get fechaExca
     *
     * @return \DateTime 
     */
    public function getFechaExca()
    {
        return $this->fechaExca;
    }

    /**
     * Set coordenadas
     *
     * @param string $coordenadas
     * @return Yacimiento
     */
    public function setCoordenadas($coordenadas)
    {
        $this->coordenadas = $coordenadas;

        return $this;
    }

    /**
     * Get coordenadas
     *
     * @return string 
     */
    public function getCoordenadas()
    {
        return $this->coordenadas;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Yacimiento
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set epoca
     *
     * @param \AppBundle\Entity\Epoca $epoca
     * @return Yacimiento
     */
    public function setEpoca(\AppBundle\Entity\Epoca $epoca)
    {
        $this->epoca = $epoca;

        return $this;
    }

    /**
     * Get epoca
     *
     * @return \AppBundle\Entity\Epoca 
     */
    public function getEpoca()
    {
        return $this->epoca;
    }

    /**
     * Set municipio
     *
     * @param \AppBundle\Entity\Municipio $municipio
     * @return Yacimiento
     */
    public function setMunicipio(\AppBundle\Entity\Municipio $municipio)
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * Get municipio
     *
     * @return \AppBundle\Entity\Municipio 
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set arqueologo
     *
     * @param \AppBundle\Entity\Arqueologo $arqueologo
     * @return Yacimiento
     */
    public function setArqueologo(\AppBundle\Entity\Arqueologo $arqueologo)
    {
        $this->arqueologo = $arqueologo;

        return $this;
    }

    /**
     * Get arqueologo
     *
     * @return \AppBundle\Entity\Arqueologo 
     */
    public function getArqueologo()
    {
        return $this->arqueologo;
    }
}
