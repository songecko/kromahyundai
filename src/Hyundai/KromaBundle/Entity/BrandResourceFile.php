<?php

namespace Hyundai\KromaBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

/**
 * BrandResourceFile
 */
class BrandResourceFile
{
    private $id;
    private $name;
    private $resource;
    private $file;
    private $brandResource;
    private $createdAt;
    private $updatedAt;

    public function getId()
    {
        return $this->id;
    }
    
    public function __construct()
    {
    	$this->createdAt = new DateTime('now');
    }

    public function setName($name)
    {
    	$this->name = $name;
    
    	return $this;
    }
    
    public function getName()
    {
    	$name = $this->name;
    	if(!$name && $this->getResource())
    	{
    		$name = $this->getResource();	
    	}
    	
    	return $this->name;
    }
    
    public function setResource($resource)
    {
        $this->resource = $resource;
    
        return $this;
    }

    public function getResource()
    {
        return $this->resource;
    }
    
    public function hasFile()
    {
    	return null !== $this->file;
    }
    
    public function getFile()
    {
    	return $this->file;
    }
    
    public function setFile(File $file)
    {
    	$this->file = $file;
    	
    	if($this->file instanceof UploadedFile)
    	{
    		$this->setName($this->file->getClientOriginalName());
    	}
    	
    	if ($this->name) {
    		$this->setUpdatedAt(new \DateTime('now'));
    	}
    }

    public function getType()
    {
    	$supportedImage = array(
    		'gif',
    		'jpg',
    		'jpeg',
    		'png'
    	);
    	
    	$supportedVideo = array(
    		'avi',
    		'mov',
    		'mp4',
    		'm4v'
    	);
    	
    	$ext = strtolower(pathinfo($this->getResource(), PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
    	if (in_array($ext, $supportedImage)) {
    		return 'image';
    	} elseif (in_array($ext, $supportedVideo)) {
    		return 'video';
    	}
    	
        return 'file';
    }
    
    public function setBrandResource(BrandResource $brandResource = null)
    {
    	$this->brandResource = $brandResource;
    
    	return $this;
    }
    
    public function getBrandResource()
    {
    	return $this->brandResource;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}