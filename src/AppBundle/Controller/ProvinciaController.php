<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Provincia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provincium controller.
 *
 */
class ProvinciaController extends Controller
{
    /**
     * Lists all provincium entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $provincias = $em->getRepository('AppBundle:Provincia')->findAll();

        return $this->render('provincia/index.html.twig', array(
            'provincias' => $provincias,
        ));
    }

    /**
     * Creates a new provincium entity.
     *
     */
    public function newAction(Request $request)
    {
        $provincium = new Provincia();
        $form = $this->createForm('AppBundle\Form\ProvinciaType', $provincium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($provincium);
            $em->flush($provincium);

            return $this->redirectToRoute('provincia_show', array('id' => $provincium->getId()));
        }

        return $this->render('provincia/new.html.twig', array(
            'provincium' => $provincium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a provincium entity.
     *
     */
    public function showAction(Provincia $provincium)
    {
        $deleteForm = $this->createDeleteForm($provincium);

        return $this->render('provincia/show.html.twig', array(
            'provincium' => $provincium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing provincium entity.
     *
     */
    public function editAction(Request $request, Provincia $provincium)
    {
        $deleteForm = $this->createDeleteForm($provincium);
        $editForm = $this->createForm('AppBundle\Form\ProvinciaType', $provincium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('provincia_edit', array('id' => $provincium->getId()));
        }

        return $this->render('provincia/edit.html.twig', array(
            'provincium' => $provincium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a provincium entity.
     *
     */
    public function deleteAction(Request $request, Provincia $provincium)
    {
        $form = $this->createDeleteForm($provincium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($provincium);
            $em->flush();
        }

        return $this->redirectToRoute('provincia_index');
    }

    /**
     * Creates a form to delete a provincium entity.
     *
     * @param Provincia $provincium The provincium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Provincia $provincium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('provincia_delete', array('id' => $provincium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
