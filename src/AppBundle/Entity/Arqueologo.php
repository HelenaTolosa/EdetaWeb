<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Arqueologo
 *
 * @ORM\Table(name="arqueologo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArqueologoRepository")
 */
class Arqueologo
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     */
    private $apellidos;

    /**
     * @var int
     *
     * @ORM\Column(name="numColegiado", type="integer", unique=true)
     */
    private $numColegiado;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="Yacimiento", mappedBy="arqueologos", cascade={"persist", "remove"})
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
     * @return Arqueologo
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
     * Set apellidos
     *
     * @param string $apellidos
     * @return Arqueologo
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set numColegiado
     *
     * @param integer $numColegiado
     * @return Arqueologo
     */
    public function setNumColegiado($numColegiado)
    {
        $this->numColegiado = $numColegiado;

        return $this;
    }

    /**
     * Get numColegiado
     *
     * @return integer 
     */
    public function getNumColegiado()
    {
        return $this->numColegiado;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Arqueologo
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
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
     * @return Arqueologo
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
