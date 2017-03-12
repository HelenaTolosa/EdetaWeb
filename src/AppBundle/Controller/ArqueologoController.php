<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Arqueologo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Arqueologo controller.
 *
 */
class ArqueologoController extends Controller
{
    /**
     * Lists all arqueologo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $arqueologos = $em->getRepository('AppBundle:Arqueologo')->findAll();

        return $this->render('arqueologo/index.html.twig', array(
            'arqueologos' => $arqueologos,
        ));
    }

    /**
     * Creates a new arqueologo entity.
     *
     */
    public function newAction(Request $request)
    {
        $arqueologo = new Arqueologo();
        $form = $this->createForm('AppBundle\Form\ArqueologoType', $arqueologo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($arqueologo);
            $em->flush($arqueologo);

            return $this->redirectToRoute('arqueologo_show', array('id' => $arqueologo->getId()));
        }

        return $this->render('arqueologo/new.html.twig', array(
            'arqueologo' => $arqueologo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a arqueologo entity.
     *
     */
    public function showAction(Arqueologo $arqueologo)
    {
        $deleteForm = $this->createDeleteForm($arqueologo);

        return $this->render('arqueologo/show.html.twig', array(
            'arqueologo' => $arqueologo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing arqueologo entity.
     *
     */
    public function editAction(Request $request, Arqueologo $arqueologo)
    {
        $deleteForm = $this->createDeleteForm($arqueologo);
        $editForm = $this->createForm('AppBundle\Form\ArqueologoType', $arqueologo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('arqueologo_edit', array('id' => $arqueologo->getId()));
        }

        return $this->render('arqueologo/edit.html.twig', array(
            'arqueologo' => $arqueologo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a arqueologo entity.
     *
     */
    public function deleteAction(Request $request, Arqueologo $arqueologo)
    {
        $form = $this->createDeleteForm($arqueologo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($arqueologo);
            $em->flush();
        }

        return $this->redirectToRoute('arqueologo_index');
    }

    /**
     * Creates a form to delete a arqueologo entity.
     *
     * @param Arqueologo $arqueologo The arqueologo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Arqueologo $arqueologo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('arqueologo_delete', array('id' => $arqueologo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
