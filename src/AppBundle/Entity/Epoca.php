<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Epoca
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Epoca
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message="Rellenar el campo nombre")
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Yacimiento", mappedBy="epoca", cascade={"persist", "remove"})
     */
    protected $yacimientos;
    
    public function __construct()
    {
    	$this->yacimeintos = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Epoca
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
     * Add yacimiento
     *
     * @param \AppBundle\Entity\Yacimiento $yacimiento
     *
     * @return Epoca
     */
    public function addYacimiento(\AppBundle\Entity\Yacimiento $yacimiento)
    {
        $this->yacimientos[] = $yacimiento;

        return $this;
    }

    /**
     * Remove yacimiento
     *
     * @param \AppBundle\Entity\Yacimiento $yacimiento
     */
    public function removeYacimiento(\AppBundle\Entity\Yacimiento $yacimiento)
    {
        $this->yacimientos->removeElement($yacimiento);
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
