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
    
    public function downloadAllAction($brandresource_id)
    {
    	$brandResource = $this->getDoctrine()
    	->getRepository('HyundaiKromaBundle:BrandResource')
    	->find($brandresource_id);
    	 
    	$path = $this->get('kernel')->getRootDir(). "/../web/media/resources/";
    	 
    	$zip = new \ZipArchive();
    	$zipName = $brandResource->getName().".zip";
    	$zip->open($path.$zipName,  \ZipArchive::OVERWRITE);
    	 
    	foreach ($brandResource->getFiles() as $file)
    	{
    		$filename = $file->getResource();
    		if(is_file($path.$filename))
    		{
    			$zip->addFile($path.$filename, $file->getName());
    		}
    	}
    	$zip->close();
    	 
    	$response = new Response();
    
    	//set headers
    	$response->headers->set('Content-Type', 'application/zip');
    	$response->headers->set('Content-Disposition', 'attachment;filename="'.$zipName);
    
    	$content = file_get_contents($path.$zipName);
    	$response->setContent($content);
    
    	return $response;
    }
    
    public function filesAction($brandresource_id)
    {
    	$config = $this->getConfiguration();
    	
    	$brandResource = $this->getDoctrine()
    		->getRepository('HyundaiKromaBundle:BrandResource')
    		->find($brandresource_id);
    	
    	$files = $brandResource->getFiles()->toArray();
    	
    	return $this->render($config->getTemplate('files.html'), array(
    		'brandResource' => $brandResource,
        	'files' => $files
        ));
    }
}
