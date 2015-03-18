<?php

namespace Hyundai\KromaBundle\Controller\Frontend;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Hyundai\KromaBundle\Entity\BrandResource;

class BrandResourceController extends ResourceController
{
    public function indexAction(Request $request)
    {
    	$rootResource = $this->getRepo()->getRootNodes();
    	$rootResource = count($rootResource) > 0?$rootResource[0]:$rootResource;    	 
    	
        return $this->render('HyundaiKromaBundle:Frontend/BrandResource:index.html.twig', array(
        	'rootResource' => $rootResource
        ));
    }
    
    public function editorAction(Request $request)
    {
    	$repo = $this->getRepo();
    	
    	try {
    		
    	if($request->get('action') == 'create')
    	{
    		$parentResource = $repo->find($request->get('id'));
    		$resource = $this->createNode($parentResource);
    		
    		return JsonResponse::create(array('error' => false, 'resource_id' => $resource->getId()));
    	}
    	if($request->get('action') == 'delete')
    	{
    		$resource = $repo->find($request->get('id'));
    		$this->getManager()->remove($resource);
    		$this->getManager()->flush();
    	
    		return JsonResponse::create(array('error' => false));
    	}
    	if($request->get('action') == 'rename')
    	{
    		$resource = $repo->find($request->get('id'));
    		$resource->setName($request->get('text'));
    		$this->getManager()->flush();
    		 
    		return JsonResponse::create(array('error' => false));
    	}
    	
    	}catch (\Exception $e){}
    	
    	return JsonResponse::create(array('error' => true));
    }
    
    public function downloadAllAction(Request $request)
    {
    	$brandResource = $this->getRepo()->find($request->get('id'));
    
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
    
    private function createNode($parentResource)
    {
    	$resource = new BrandResource();
    	$resource->setName('Untitled');
    	
    	$this->getRepo()->persistAsLastChildOf($resource, $parentResource);    	
    	$this->getManager()->flush();
    	
    	return $resource;
    }
    
    private function getRepo()
    {
    	return $this->getManager()->getRepository('Hyundai\KromaBundle\Entity\BrandResource');
    }
}
