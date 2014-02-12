<?php

namespace Hyundai\KromaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Faker\Factory as FakerFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Finder\Finder;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Hyundai\KromaBundle\Entity\User;
use Hyundai\KromaBundle\Entity\Post;
use Hyundai\KromaBundle\Entity\PostResource;

class LoadKromaData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
	protected $faker;
    protected $container;    
    /**
    * Constructor.
    */
    public function __construct()
    {
        $this->faker = FakerFactory::create();
    }
    
    public function setContainer(ContainerInterface $container = null)
    {
    	$this->container = $container;
    }
    
    protected function get($id)
    {
    	return $this->container->get($id);
    }
    
    public function getOrder()
    {
    	return 4;
    }    
    
    public function load(ObjectManager $manager)
    {
    	$userAdmin = new User();
    	$userAdmin->setUsername('admin');
    	$userAdmin->setEmail('admin@hyundai.com');
    	$userAdmin->setPlainPassword('123456');
    	$userAdmin->setEnabled(true);
    	$userAdmin->setRoles(array('ROLE_ADMIN'));
    	
    	$manager->persist($userAdmin);
    	 
    	$user1 = new User();
    	$user1->setUsername('user1@hyundai.com');
    	$user1->setEmail('user1@hyundai.com');
    	$user1->setPlainPassword('123456');
    	$user1->setEnabled(true);
    	$user1->setRoles(array('ROLE_USER'));
    	
    	$manager->persist($user1);
    	 
    	$user2 = new User();
    	$user2->setUsername('user2@hyundai.com');
    	$user2->setEmail('user2@hyundai.com');
    	$user2->setPlainPassword('12345678');
    	$user2->setEnabled(true);
    	$user2->setRoles(array('ROLE_USER'));
    	 
    	$manager->persist($user2);
    	
    	$post = new Post();
    	$post->setTitle($this->faker->word);
    	$post->setDate(new \DateTime("now"));
    	$post->setDescription($this->faker->text);
    	
    	$manager->persist($post);
    	
    	for($i=1;$i<5;$i++)
    	{
    		$resource = new PostResource();
    		$resource->setPost($post);
    		$resource->setName($this->faker->word);
    		$resource->setType('image');
    		$resource->setResource('imagen'.$i);
    		
    		$manager->persist($resource);
    	}
    	
    	$manager->flush();
    }
}
