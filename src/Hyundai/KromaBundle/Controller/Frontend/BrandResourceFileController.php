<?php

namespace Hyundai\KromaBundle\Controller\Frontend;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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
    
    public function multipleCreateAction($brandresource_id)
    {
    	$files = array();
    	$filesBag = $this->getRequest()->files->all();
    	$brandResource = $this->getDoctrine()
    		->getRepository('HyundaiKromaBundle:BrandResource')
    		->find($brandresource_id);
    	
    	if(!$brandResource) return;
    	if(!isset($filesBag['files'])) return;
    	
    	foreach ($filesBag['files'] as $uploadedFile)
    	{
	    	$file = new \stdClass();
	    	$file->name = $uploadedFile->getClientOriginalName();
	    	$file->size = $uploadedFile->getClientSize();
	    	$file->type = $uploadedFile->getClientMimeType();
	    	
    		//Save to db
    		$resourceFile = $this->createNew();
    		$resourceFile->setBrandResource($brandResource);
    		$resourceFile->setName($file->name);
    		$resourceFile->setFile($uploadedFile);
    		
    		$this->getManager()->persist($resourceFile);
    		
	    	$files[] = $file;
    	}
    	
    	$this->getManager()->flush();
    		
    	$response = array('files' => $files);
    	
    	return JsonResponse::create($response);
    }
}
