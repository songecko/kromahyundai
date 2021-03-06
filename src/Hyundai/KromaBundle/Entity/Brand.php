<?php

namespace Hyundai\KromaBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Brand
 */
class Brand
{
    private $id;
    private $title;
    private $date;
    private $description;
    private $resources;
    private $createdAt;
    private $updatedAt;
    
	public function __construct()
    {
        $this->resources = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdAt = new DateTime('now');
    }

    public function getId()
    {
    	return $this->id;
    }
    
    public function setTitle($title)
    {
    	$this->title = $title;
    
    	return $this;
    }
    
    public function getTitle()
    {
    	return $this->title;
    }
    
    public function setDate($date)
    {
    	$this->date = $date;
    
    	return $this;
    }
    
    public function getDate()
    {
    	return $this->date;
    }
    
    public function setDescription($description)
    {
    	$this->description = $description;
    
    	return $this;
    }
    
    public function getDescription()
    {
    	return $this->description;
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
    
    public function __toString()
    {
    	return $this->getTitle();
    }
}