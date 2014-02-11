<?php

namespace Hyundai\KromaBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * PostResource
 */
class PostResource
{
    private $id;
    private $name;
    private $resource;
    private $type;
    private $post;
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

    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setPost(\Hyundai\KromaBundle\Entity\Post $post = null)
    {
        $this->post = $post;
    
        return $this;
    }

    public function getPost()
    {
        return $this->post;
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