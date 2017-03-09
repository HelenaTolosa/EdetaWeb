<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Epoca;

class EpocaController extends Controller {
	

	public function createAction($name) {
		
		$epoca= new Epoca();
		$epoca->setName($name);
		 
		$em= $this->getDoctrine()->getManager();
	
		$em->persist($epoca);
		$em->flush();
		 
		return $this->render('main/dispatch.html.twig', array('dispatch'=>sprintf("La Epoca %s(%d) ha sido creada con éxito.", $epoca->getName(), $epoca->getId())));
	}

	public function deleteAction($id) {
		
		$epoca= $this->getDoctrine()->getRepository('AppBundle:Epoca')->find($id);
		
		$em= $this->getDoctrine()->getManager();
		 
		$em->remove($epoca);
		$em->flush();
	
		return $this->redirectToRoute('yacimientolist');		
	}
	public function listAction() {
		
		$epocas= $this->getDoctrine()->getRepository('AppBundle:Epoca')-> findBy(array(), array('id'=> 'ASC'));			
			
		return $this->render('epoca/list.html.twig', array('epocas'=>$epocas));		
	}
	public function newEpocaAction(Request $request) {
	
			$em = $this->getDoctrine ()->getManager ();
		
			$epoca = new Epoca();
		
				$form = $this->createFormBuilder ($epoca,['translation_domain'=> 'AppBundle'])
				->add ('name', 'text', array('label'=> 'epoca.name'))
				->add ('save', 'submit', array('label'=> 'form.save'))
				->add('saveAndAdd', 'submit', array('label'=> 'form.save_add'))
				->getForm();
				
			$form->handleRequest ($request);
		
			if ($form-> isValid()) {
				 
				$em->persist($epoca);
				$em->flush();				 
				 
					return $form->get('saveAndAdd')->isClicked()
					? $this->redirectToRoute('formepocanew',array(),301)
					: $this->redirectToRoute('epocalist',array(),301);		
			}
		
			return $this-> render('epoca/new.html.twig', array('form' => $form->createView ()));
    	}

    public function editEpocaAction($id, Request $request) {
    	
    		$em = $this->getDoctrine()->getManager ();
    	
    		$epoca= $em-> getRepository('AppBundle:Epoca')-> find($id);
    	
    		$form = $this->createFormBuilder ($epoca,['translation_domain'=> 'AppBundle'])
    		->add ('name', 'text', array('label'=> 'epoca.name'))
    		->add ('save', 'submit', array('label'=> 'form.save'))    		
    		->getForm();
    	
    		$form->handleRequest ($request);
    	
    		if ($form-> isValid()) {
    				
    			$em->persist($epoca);
    			$em->flush();
    				
			return $this->redirectToRoute('epocalist',array(),301);
    		}
    	
    		return $this-> render('epoca/new.html.twig', array('form' => $form->createView ()));
    	}







}

	