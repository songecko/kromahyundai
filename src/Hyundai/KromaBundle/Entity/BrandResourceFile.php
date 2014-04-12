<?php

namespace Hyundai\KromaBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * BrandResourceFile
 */
class BrandResourceFile
{
    private $id;
    private $resource;
    private $file;
    private $type;
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
    	 
    	if ($this->resource) {
    		$this->setUpdatedAt(new \DateTime('now'));
    	}
    }

    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    public function getType()
    {
        return $this->type;
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