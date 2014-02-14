<?php

namespace Hyundai\KromaBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function dashboardAction()
    {
        return $this->render('HyundaiKromaBundle:Frontend/Main:dashboard.html.twig');
    }
}
