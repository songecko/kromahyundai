<?php

namespace Hyundai\KromaBundle\Controller\Frontend;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;

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
}
