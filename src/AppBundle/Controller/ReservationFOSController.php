<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Reservation;

class ReservationFOSController extends FOSRestController {
    
    public function deleteReservationAction($reservationId) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Reservation')->find($reservationId);
        $em->remove($entity);
        $em->flush();
    }
    
    public function getReservationAction($reservationId) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Reservation')->find($reservationId);
        return $entity;
    }
    
    public function putReservationAction($reservationId, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Reservation')->find($reservationId);
        $entity->setDatetime(new \Datetime('now'));
        $entity->setCourt($em->getRepository('AppBundle:Court')->find($request->query->get('courtid')));
        $entity->setUser($em->getRepository('AppBundle:User')->find($request->query->get('userid')));
        $em->persist($entity);
        $em->flush();
    }
    
    public function getReservationsAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Reservation')->findAll();
        return $entities;
    }
    
    public function postReservationsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entity = new Reservation();
        $entity->setDatetime(new \Datetime('now'));
        $entity->setCourt($em->getRepository('AppBundle:Court')->find($request->query->get('courtid')));
        $entity->setUser($em->getRepository('AppBundle:User')->find($request->query->get('userid')));
        $em->persist($entity);
        $em->flush();
    }
}