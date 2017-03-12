<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Epoca;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Epoca controller.
 *
 */
class EpocaController extends Controller
{
    /**
     * Lists all epoca entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $epocas = $em->getRepository('AppBundle:Epoca')->findAll();

        return $this->render('epoca/index.html.twig', array(
            'epocas' => $epocas,
        ));
    }

    /**
     * Creates a new epoca entity.
     *
     */
    public function newAction(Request $request)
    {
        $epoca = new Epoca();
        $form = $this->createForm('AppBundle\Form\EpocaType', $epoca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($epoca);
            $em->flush($epoca);

            return $this->redirectToRoute('epoca_show', array('id' => $epoca->getId()));
        }

        return $this->render('epoca/new.html.twig', array(
            'epoca' => $epoca,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a epoca entity.
     *
     */
    public function showAction(Epoca $epoca)
    {
        $deleteForm = $this->createDeleteForm($epoca);

        return $this->render('epoca/show.html.twig', array(
            'epoca' => $epoca,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing epoca entity.
     *
     */
    public function editAction(Request $request, Epoca $epoca)
    {
        $deleteForm = $this->createDeleteForm($epoca);
        $editForm = $this->createForm('AppBundle\Form\EpocaType', $epoca);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('epoca_edit', array('id' => $epoca->getId()));
        }

        return $this->render('epoca/edit.html.twig', array(
            'epoca' => $epoca,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a epoca entity.
     *
     */
    public function deleteAction(Request $request, Epoca $epoca)
    {
        $form = $this->createDeleteForm($epoca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($epoca);
            $em->flush();
        }

        return $this->redirectToRoute('epoca_index');
    }

    /**
     * Creates a form to delete a epoca entity.
     *
     * @param Epoca $epoca The epoca entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Epoca $epoca)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('epoca_delete', array('id' => $epoca->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
