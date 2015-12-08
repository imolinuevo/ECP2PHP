<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Court;
use AppBundle\Form\CourtType;

/**
 * Court controller.
 *
 */
class CourtController extends Controller
{
    /**
     * Lists all Court entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $courts = $em->getRepository('AppBundle:Court')->findAll();

        return $this->render('court/index.html.twig', array(
            'courts' => $courts,
        ));
    }

    /**
     * Creates a new Court entity.
     *
     */
    public function newAction(Request $request)
    {
        $court = new Court();
        $form = $this->createForm(new CourtType(), $court);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($court);
            $em->flush();

            return $this->redirectToRoute('courts_show', array('id' => $court->getId()));
        }

        return $this->render('court/new.html.twig', array(
            'court' => $court,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Court entity.
     *
     */
    public function showAction(Court $court)
    {
        $deleteForm = $this->createDeleteForm($court);

        return $this->render('court/show.html.twig', array(
            'court' => $court,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Court entity.
     *
     */
    public function editAction(Request $request, Court $court)
    {
        $deleteForm = $this->createDeleteForm($court);
        $editForm = $this->createForm(new CourtType(), $court);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($court);
            $em->flush();

            return $this->redirectToRoute('courts_edit', array('id' => $court->getId()));
        }

        return $this->render('court/edit.html.twig', array(
            'court' => $court,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Court entity.
     *
     */
    public function deleteAction(Request $request, Court $court)
    {
        $form = $this->createDeleteForm($court);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($court);
            $em->flush();
        }

        return $this->redirectToRoute('courts_index');
    }

    /**
     * Creates a form to delete a Court entity.
     *
     * @param Court $court The Court entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Court $court)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('courts_delete', array('id' => $court->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
