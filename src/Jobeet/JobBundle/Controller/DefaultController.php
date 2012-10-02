<?php

namespace Jobeet\JobBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('JobeetJobBundle:Default:index.html.twig', array('name' => $name));
    }
}
