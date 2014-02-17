<?php

namespace Hyundai\KromaBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * BrandResourceCategory
 */
class BrandResourceCategory
{
    private $id;
    private $name;
    private $resources;
    private $createdAt;
    private $updatedAt;

    public function getId()
    {
        return $this->id;
    }
    
    public function __construct()
    {
    	$this->resources = new \Doctrine\Common\Collections\ArrayCollection();
    	$this->createdAt = new DateTime('now');
    }
    
    public function setName($name)
    {
    	$this->name = $name;
    
    	return $this;
    }
    
    public function getName()
    {
    	return $this->name;
    }
        
    public function addResource(BrandResource $resource)
    {
    	$this->resources[] = $resource;
    
    	return $this;
    }
    
    public function removeResource(BrandResource $resource)
    {
    	$this->resources->removeElement($resource);
    }
    
    public function getResources()
    {
    	return $this->resources;
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
    
    public function __toString()
    {
    	return $this->getName();
    }
}