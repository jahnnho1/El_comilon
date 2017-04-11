<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SeguridadController extends Controller
{
    public function indexAction()
    {
        return $this->render('BackendBundle:Default:index.html.twig');
    }
}
