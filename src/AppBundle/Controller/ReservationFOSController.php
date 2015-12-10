<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
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
    
    public function putReservationAction($reservationId) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Reservation')->find($reservationId);
        //set params
        $em->persist($entity);
        $em->flush();
    }
    
    public function getReservationsAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Reservation')->findAll();
        return $entities;
    }
    
    public function postReservationsAction() {
        $entity = new Reservation();
        //set params
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
    }
}