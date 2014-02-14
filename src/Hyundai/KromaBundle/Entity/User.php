<?php

namespace Hyundai\KromaBundle\Entity;

use DateTime;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User extends BaseUser
{
    protected $id;
    private $firstName;
    private $lastName;
    private $createdAt;
    private $updatedAt;


    public function __construct()
    {   
        $this->createdAt = new DateTime('now');
        
        parent::__construct();
        $this->setEnabled(true);
        $this->addRole('ROLE_USER');
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }
    
    public function setLastName($lastName)
    {
    	$this->lastName = $lastName;
    
    	return $this;
    }
    
    public function getLastName()
    {
    	return $this->lastName;
    }
    
    public function getFullname()
    {
    	return $this->getFirstName().' '.$this->getLastName();
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