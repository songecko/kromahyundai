<?php

namespace Hyundai\KromaBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function dashboardAction()
    {
        return $this->render('HyundaiKromaBundle:Frontend/Main:dashboard.html.twig');
    }
    
    public function redirectIndexUserAction()
    {
    	if($this->get('security.context')->isGranted('ROLE_ADMIN'))
    	{
    		return $this->redirect($this->generateUrl('hyundai_kroma_brand_index'));
    	}else {
    		return $this->redirect($this->generateUrl('hyundai_kroma_branduser_index'));
    	}
    }
}
