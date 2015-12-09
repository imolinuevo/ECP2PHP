<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;

class ReservationFOSController extends FOSRestController {
    public function getReservationAction($id)
    {
        return array('hello' => $id);
    }
}