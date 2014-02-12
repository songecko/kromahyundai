<?php

namespace Hyundai\KromaBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('HyundaiKromaBundle:Frontend/Main:index.html.twig');
    }
}
