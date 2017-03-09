<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Epoca;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="yacimiento")
 */
class Yacimiento
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Rellenar el campo nombre")
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=100)     
     */
    protected $municipio;

    /**
     * @ORM\Column(type="text" , nullable=true)
     */
    protected $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="Epoca", inversedBy="yacimientos")
     * @ORM\JoinColumn(name="epoca_id", referencedColumnName="id", nullable=false)
     */
    protected $epoca;

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
     * Set name
     *
     * @param string $name
     *
     * @return Yacimiento
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set municipio
     *
     * @param string $municipio
     *
     * @return Yacimiento
     */
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * Get municipio
     *
     * @return string
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Yacimiento
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set epoca
     *
     * @param Epoca $epoca
     *
     * @return Yacimiento
     */
    public function setEpoca(Epoca $epoca = null)
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

}
