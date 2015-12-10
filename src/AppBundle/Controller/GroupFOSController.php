<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Group;

class GroupFOSController extends FOSRestController {
    
    public function getGroupAction($groupId) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Group')->find($groupId);
        return $entity;
    }
    
    public function putGroupAction($groupId, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Group')->find($groupId);
        $entity->setName($request->query->get('name'));
        $em->persist($entity);
        $em->flush();
    }
    
    public function getGroupsAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Group')->findAll();
        return $entities;
    }
    
    public function postGroupsAction(Request $request) {
        $entity = new Group();
        $entity->setName($request->query->get('name'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
    }
    
    public function postGroupUserAction($groupId, $userId) {
        $em = $this->getDoctrine()->getManager();
        $group = $em->getRepository('AppBundle:Group')->find($groupId);
        $user = $em->getRepository('AppBundle:User')->find($userId);
        $group->addUser($user);
        $em->persist($group);
        $em->flush();
    }
    
    public function deleteGroupAction($groupId) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Group')->find($groupId);
        $em->remove($entity);
        $em->flush();
    }
}