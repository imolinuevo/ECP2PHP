<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;

class UserFOSController extends FOSRestController {
    public function getUserAction($id)
    {
        return array('hello' => $id);
    }
}