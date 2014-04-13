<?php

namespace Hyundai\KromaBundle\Controller\Frontend;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Response;

class BrandResourceFileController extends ResourceController
{    
    public function downloadAction()
    {
    	$brandResourceFile = $this->findOr404();    	
    	$request = $this->get('request');
    	
    	$filename = $brandResourceFile->getResource();
    	$path = $this->get('kernel')->getRootDir(). "/../web/media/resources/";
    	$content = file_get_contents($path.$filename);
    	
    	$response = new Response();
    	
    	//set headers
    	$response->headers->set('Content-Type', 'mime/type');
    	$response->headers->set('Content-Disposition', 'attachment;filename="'.$brandResourceFile->getName());
    	
    	$response->setContent($content);
    	
    	return $response;
    }
}
