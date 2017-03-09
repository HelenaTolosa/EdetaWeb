<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Yacimiento;
use AppBundle\Entity\Epoca;



class YacimientoController extends Controller {

	public function createStaticAction() {
		
		$em = $this->getDoctrine()->getManager();
	
		$epocas= $this->getDoctrine ()->getRepository('AppBundle:Epoca')->findAll();
		
		$epoca = new Epoca();
		$epoca->setName(sprintf("Epoca%d", rand(1,10))); // Evito la epoca cero
	
		$yacimiento= new Yacimiento();
		$yacimiento->setName('Nombre Yacimiento');
		$yacimiento->setMunicipio('Valencia');
		$yacimiento->setDescription('Sit tibi terra levis');
		// relacionamos con epoca
		$yacimiento->setEpoca($epoca);
	
		$em->persist($epoca);
		$em->persist($yacimiento);
		$em->flush();
	
		return $this->render('main/dispatch.html.twig', array ('dispatch'=> sprintf("El yacimiento %s (%d) ha sido creado con éxito.", $yacimiento->getName(), $yacimiento->getId())));
		
	}
	public function showAction($id) {
		
		$yacimiento= $this->getDoctrine()->getRepository('AppBundle:Yacimiento')->find($id);
	
		if (!$yacimiento) {
			return $this->render('main/message.html.twig', array('message'=>sprintf("El yacimiento id: %d, no existe", $id)));
		}
	
		return $this->render('yacimiento/show.html.twig', array('yacimiento'=>$yacimiento));
		
	}

	public function listAction() {
		
		$yacimientos= $this->getDoctrine()->getRepository('AppBundle:Yacimiento')->findBy(array(),array('id'=>'ASC'));
	
		return $this->render('yacimiento/list.html.twig', array('yacimientos'=>$yacimientos));
		
	}

	public function createParamAction($name, $municipio) {
		
		$em= $this->getDoctrine()->getManager();
	
		$epocas= $this->getDoctrine()->getRepository ('AppBundle:Epoca')->findAll();
	
		$epoca= new Epoca();
		$epoca->setName(sprintf("Epoca%d", rand(1,10))); // Evito la epoca cero
		
		$yacimiento= new Yacimiento();
		$yacimiento->setName($name);
		$yacimiento->setMunicipio($municipio);
		$yacimiento->setDescription(sprintf('Descripción de %s', $name));
		// La sigiente línea relaciona la epoca
		$yacimiento->setEpoca($epoca);
	
		$em->persist($epoca);
		$em->persist($yacimiento);	
		$em->flush();
	
		return $this->render('main/dispatch.html.twig', array('dispatch' => sprintf ("El Yacimiento %s (%d) ha sido creado con éxito.", $yacimiento->getName(), $yacimiento->getId())));
	}
	public function listByEpocaAction($name) {
		
		$epocas= $this->getDoctrine()->getRepository('AppBundle:Epoca')->findByName($name);
	
		return $this->render('yacimiento/listbyepoca.html.twig', array('epocas'=>$epocas));
	
	}	
	public function listAllByEpocaAction() {
	
		$epocas= $this->getDoctrine()->getRepository('AppBundle:Epoca')->findAll();
	
		return $this->render('yacimiento/listbyepoca.html.twig', array('epocas'=>$epocas));
	
	}

	public function deleteAction($id) {
		
		$yacimiento= $this->getDoctrine()->getRepository('AppBundle:Yacimiento')->find($id);
		
		$em= $this->getDoctrine()->getManager();
		
		$em->remove($yacimiento);
		$em->flush();
		
		return $this->redirectToRoute ('yacimientolist');		
		
	}	

	public function newYacimientoAction(Request $request) {
	
		$em= $this->getDoctrine()->getManager ();
	
		$yacimiento= new Yacimiento();
	
		$form= $this->createFormBuilder($yacimiento, ['translation_domain'=> 'AppBundle'])
		
				->add('name', 'text', array('label'=> 'yacimiento.name'))
				->add('description', 'text', array('label'=> 'yacimiento.description', 'required' => false))
				->add('municipio', 'text', array('label'=> 'yacimiento.municipio'))
				->add('epoca', 'entity', array('label'=> 'yacimiento.epoca', 'class'=> 'AppBundle:Epoca', 'choice_label'=> 'name' ))
				->add('save', 'submit', array('label'=> 'form.save'))
				->add('saveAndAdd', 'submit', array('label'=> 'form.save_add'))
				->getForm();
	
					$form->handleRequest($request);
	
						if ($form->isValid()) {
								
							$em->persist($yacimiento);
							$em->flush();										
									
							return $form->get('saveAndAdd')->isClicked()
							? $this->redirectToRoute('formyacimientonew',array(),301)
							: $this->redirectToRoute('yacimientolist',array(),301);
							}
	
						return $this->render('yacimiento/new.html.twig', array('form' => $form->createView()));
		}

	public function editYacimientoAction($id, Request $request) {
		
		$em= $this->getDoctrine()->getManager ();
		
		$yacimiento= $em-> getRepository('AppBundle:Yacimiento')-> find($id);
		
		$form= $this->createFormBuilder($yacimiento, ['translation_domain'=> 'AppBundle'])
		
		->add('name', 'text', array('label'=> 'yacimiento.name'))
		->add('description', 'text', array('label'=> 'yacimiento.description', 'required' => false))
		->add('municipio', 'text', array('label'=> 'yacimiento.municipio', 'invalid_message'=> 'yacimiento.flash.municipio'))
		->add('epoca', 'entity', array('label'=> 'yacimiento.epoca', 'class'=> 'AppBundle:Epoca', 'choice_label'=> 'name' ))
		->add('save', 'submit', array('label'=> 'form.save'))			
		->getForm();
		
		$form->handleRequest($request);
		
		if ($form->isValid()) {
		
			$em->persist($yacimiento);
			$em->flush();
					
		return $this->redirectToRoute('yacimientolist',array(),301);
		}
		
		return $this->render('yacimiento/new.html.twig', array('form' => $form->createView()));
	}
}
		