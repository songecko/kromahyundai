<?php

namespace Hyundai\KromaBundle\Controller\Frontend;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Response;

class BrandController extends ResourceController
{
    public function showAction()
    {
    	$config = $this->getConfiguration();
    	
    	$brand = $this->findOr404();
    	
    	$resourcesCategories = array();
    	
    	foreach ($brand->getResources() as $resource)
    	{
    		$catName = $resource->getCategory()->getName();
    		if(!isset($resourcesCategories[$catName]))
    		{
    			$resourcesCategories[$catName] = array(
    				'resources' => array()
    			);
    		}
    		
    		$resourcesCategories[$catName]['resources'][] = $resource;
    	}
    	
        return $this->render($config->getTemplate('show.html'), array(
        	$config->getResourceName() => $brand,
        	'resourcesCategories' => $resourcesCategories
        ));
    }
    
    public function downloadAction($filename)
    {
    	$request = $this->get('request');
    	$path = $this->get('kernel')->getRootDir(). "/../web/media/resources/";
    	$content = file_get_contents($path.$filename);
    	
    	$response = new Response();
    	
    	//set headers
    	$response->headers->set('Content-Type', 'mime/type');
    	$response->headers->set('Content-Disposition', 'attachment;filename="'.$filename);
    	
    	$response->setContent($content);
    	
    	return $response;
    }
}
