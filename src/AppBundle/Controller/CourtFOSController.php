<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Court;

class CourtFOSController extends FOSRestController {
    
    public function deleteCourtAction($courtId) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Court')->find($courtId);
        $em->remove($entity);
        $em->flush();
    }
    
    public function getCourtAction($courtId) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Court')->find($courtId);
        return $entity;
    }
    
    public function putCourtAction($courtId) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Court')->find($courtId);
        //set params
        $em->persist($entity);
        $em->flush();
    }
    
    public function getCourtsAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Court')->findAll();
        return $entities;
    }
    
    public function postCourtsAction() {
        $entity = new Court();
        //set params
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
    }
}