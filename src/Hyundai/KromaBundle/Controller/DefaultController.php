<?php

namespace Hyundai\KromaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HyundaiKromaBundle:Default:index.html.twig');
    }
}
