<?php

namespace Hyundai\KromaBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * BrandResource
 */
class BrandResource
{
    private $id;
    private $name;
    private $category;
    private $brand;
    private $files;
    private $createdAt;
    private $updatedAt;

    public function getId()
    {
        return $this->id;
    }
    
    public function __construct()
    {
    	$this->files = new \Doctrine\Common\Collections\ArrayCollection();
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
    
    public function setCategory(BrandResourceCategory $category)
    {
    	$this->category = $category;
    
    	return $this;
    }
    
    public function getCategory()
    {
    	return $this->category;
    }
    
    public function setBrand(Brand $brand = null)
    {
        $this->brand = $brand;
    
        return $this;
    }

    public function getBrand()
    {
        return $this->brand;
    }
    
    public function addFile(BrandResourceFile $file)
    {
    	$this->files[] = $file;
    
    	return $this;
    }
    
    public function removeFile(BrandResourceFile $file)
    {
    	$this->files->removeElement($file);
    }
    
    public function getFiles()
    {
    	return $this->files;
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