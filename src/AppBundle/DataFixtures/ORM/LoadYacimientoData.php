<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Yacimiento;

class LoadYacimientoData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        
        $symbonfy_base_dir = $this->container->getParameter('kernel.root_dir');
        $data_dir = $symbonfy_base_dir . '/Resources/data/';
        
        $row = 0;
        if (($fd = fopen($data_dir . 'yacimientos.csv', "r")) !== FALSE) {
            while (($data = fgetcsv($fd, 1000, ",")) !== FALSE) {
                $row++;
                
                if ($row == 1) continue; //skip header              
                $yacimiento = new Yacimiento();
                $yacimiento->setName($data[0]);
                $yacimiento->setDescription($data[1]);
                $yacimiento->setEpoca($this->getReference($data[2]));
                $yacimiento->setMunicipio($data[3]);
                $manager->persist($yacimiento);            
            }
            fclose($fd);
        }       
        
        $manager->flush();
    }
    
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
    
    /**
     * @override
     */
    public function getEnvironments()
    {
        return array('prod','dev','test');
    }
}