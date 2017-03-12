<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Yacimiento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Yacimiento controller.
 *
 */
class YacimientoController extends Controller
{
    /**
     * Lists all yacimiento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $yacimientos = $em->getRepository('AppBundle:Yacimiento')->findAll();

        return $this->render('yacimiento/index.html.twig', array(
            'yacimientos' => $yacimientos,
        ));
    }

    /**
     * Creates a new yacimiento entity.
     *
     */
    public function newAction(Request $request)
    {
        $yacimiento = new Yacimiento();
        $form = $this->createForm('AppBundle\Form\YacimientoType', $yacimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($yacimiento);
            $em->flush($yacimiento);

            return $this->redirectToRoute('yacimiento_show', array('id' => $yacimiento->getId()));
        }

        return $this->render('yacimiento/new.html.twig', array(
            'yacimiento' => $yacimiento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a yacimiento entity.
     *
     */
    public function showAction(Yacimiento $yacimiento)
    {
        $deleteForm = $this->createDeleteForm($yacimiento);

        return $this->render('yacimiento/show.html.twig', array(
            'yacimiento' => $yacimiento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing yacimiento entity.
     *
     */
    public function editAction(Request $request, Yacimiento $yacimiento)
    {
        $deleteForm = $this->createDeleteForm($yacimiento);
        $editForm = $this->createForm('AppBundle\Form\YacimientoType', $yacimiento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('yacimiento_edit', array('id' => $yacimiento->getId()));
        }

        return $this->render('yacimiento/edit.html.twig', array(
            'yacimiento' => $yacimiento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a yacimiento entity.
     *
     */
    public function deleteAction(Request $request, Yacimiento $yacimiento)
    {
        $form = $this->createDeleteForm($yacimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($yacimiento);
            $em->flush();
        }

        return $this->redirectToRoute('yacimiento_index');
    }

    /**
     * Creates a form to delete a yacimiento entity.
     *
     * @param Yacimiento $yacimiento The yacimiento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Yacimiento $yacimiento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('yacimiento_delete', array('id' => $yacimiento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
