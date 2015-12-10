<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
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
    
    public function putUserAction($userId, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:User')->find($userId);
        $entity->setUsername($request->query->get('username'));
        $entity->setUsernameCanonical(strtolower($request->query->get('username')));
        $entity->setEmail($request->query->get('email'));
        $entity->setEmailCanonical(strtolower($request->query->get('email')));
        $entity->setEnabled(true);
        $entity->setSalt("salt");
        $entity->setPassword($request->query->get('password'));
        $entity->setLocked(false);
        $entity->setExpired(false);
        $entity->setCredentialsExpireAt(new \DateTime('2000-01-01'));
        $entity->setCredentialsExpired(false);
        $em->persist($entity);
        $em->flush();
    }
    
    public function getUsersAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:User')->findAll();
        return $entities;
    }
    
    public function postUsersAction(Request $request) {
        $entity = new User();
        $entity->setUsername($request->query->get('username'));
        $entity->setUsernameCanonical(strtolower($request->query->get('username')));
        $entity->setEmail($request->query->get('email'));
        $entity->setEmailCanonical(strtolower($request->query->get('email')));
        $entity->setEnabled(true);
        $entity->setSalt("salt");
        $entity->setPassword($request->query->get('password'));
        $entity->setLocked(false);
        $entity->setExpired(false);
        $entity->setCredentialsExpireAt(new \DateTime('2000-01-01'));
        $entity->setCredentialsExpired(false);
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