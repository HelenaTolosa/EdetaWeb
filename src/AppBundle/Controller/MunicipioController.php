<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Municipio;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Municipio controller.
 *
 */
class MunicipioController extends Controller
{
    /**
     * Lists all municipio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $municipios = $em->getRepository('AppBundle:Municipio')->findAll();

        return $this->render('municipio/index.html.twig', array(
            'municipios' => $municipios,
        ));
    }

    /**
     * Creates a new municipio entity.
     *
     */
    public function newAction(Request $request)
    {
        $municipio = new Municipio();
        $form = $this->createForm('AppBundle\Form\MunicipioType', $municipio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($municipio);
            $em->flush($municipio);

            return $this->redirectToRoute('municipio_show', array('id' => $municipio->getId()));
        }

        return $this->render('municipio/new.html.twig', array(
            'municipio' => $municipio,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a municipio entity.
     *
     */
    public function showAction(Municipio $municipio)
    {
        $deleteForm = $this->createDeleteForm($municipio);

        return $this->render('municipio/show.html.twig', array(
            'municipio' => $municipio,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing municipio entity.
     *
     */
    public function editAction(Request $request, Municipio $municipio)
    {
        $deleteForm = $this->createDeleteForm($municipio);
        $editForm = $this->createForm('AppBundle\Form\MunicipioType', $municipio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('municipio_edit', array('id' => $municipio->getId()));
        }

        return $this->render('municipio/edit.html.twig', array(
            'municipio' => $municipio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a municipio entity.
     *
     */
    public function deleteAction(Request $request, Municipio $municipio)
    {
        $form = $this->createDeleteForm($municipio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($municipio);
            $em->flush();
        }

        return $this->redirectToRoute('municipio_index');
    }

    /**
     * Creates a form to delete a municipio entity.
     *
     * @param Municipio $municipio The municipio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Municipio $municipio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('municipio_delete', array('id' => $municipio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
