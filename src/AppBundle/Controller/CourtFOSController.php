<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;

class CourtFOSController extends FOSRestController {
    public function getCourtAction($id)
    {
        return array('hello' => $id);
    }
}