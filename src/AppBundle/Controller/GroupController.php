<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Group;
use AppBundle\Form\GroupType;

/**
 * Group controller.
 *
 */
class GroupController extends Controller
{
    /**
     * Lists all Group entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groups = $em->getRepository('AppBundle:Group')->findAll();

        return $this->render('group/index.html.twig', array(
            'groups' => $groups,
        ));
    }

    /**
     * Creates a new Group entity.
     *
     */
    public function newAction(Request $request)
    {
        $group = new Group();
        $form = $this->createForm(new GroupType(), $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();

            return $this->redirectToRoute('groups_show', array('id' => $group->getId()));
        }

        return $this->render('group/new.html.twig', array(
            'group' => $group,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Group entity.
     *
     */
    public function showAction(Group $group)
    {
        $deleteForm = $this->createDeleteForm($group);

        return $this->render('group/show.html.twig', array(
            'group' => $group,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Group entity.
     *
     */
    public function editAction(Request $request, Group $group)
    {
        $deleteForm = $this->createDeleteForm($group);
        $editForm = $this->createForm(new GroupType(), $group);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();

            return $this->redirectToRoute('groups_edit', array('id' => $group->getId()));
        }

        return $this->render('group/edit.html.twig', array(
            'group' => $group,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Group entity.
     *
     */
    public function deleteAction(Request $request, Group $group)
    {
        $form = $this->createDeleteForm($group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($group);
            $em->flush();
        }

        return $this->redirectToRoute('groups_index');
    }

    /**
     * Creates a form to delete a Group entity.
     *
     * @param Group $group The Group entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Group $group)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('groups_delete', array('id' => $group->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
