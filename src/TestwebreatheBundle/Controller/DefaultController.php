<?php

namespace TestwebreatheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TestwebreatheBundle:Default:index.html.twig');
    }
}
