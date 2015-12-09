<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;

class GroupFOSController extends FOSRestController {
    public function getGroupAction($id)
    {
        return array('hello' => $id);
    }
}