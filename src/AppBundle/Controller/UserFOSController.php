<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\User;

class UserFOSController extends FOSRestController {
    
    public function deleteUserAction($userId) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:User')->find($userId);
        $em->remove($entity);
        $em->flush();
    }
    
    public function getUserAction($userId) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:User')->find($userId);
        return $entity;
    }
    
    public function putUserAction($userId) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:User')->find($userId);
        //set params
        $em->persist($entity);
        $em->flush();
    }
    
    public function getUsersAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:User')->findAll();
        return $entities;
    }
    
    public function postUsersAction() {
        $entity = new User();
        //set params
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
    }
    
    public function postUserGroupAction($userId, $groupId) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($userId);
        $group = $em->getRepository('AppBundle:Group')->find($groupId);
        $user->addGroup($group);
        $em->persist($user);
        $em->flush();
    }
}