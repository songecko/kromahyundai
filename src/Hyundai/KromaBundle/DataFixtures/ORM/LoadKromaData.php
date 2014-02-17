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
use Hyundai\KromaBundle\Entity\Brand;
use Hyundai\KromaBundle\Entity\BrandResourceCategory;

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
    	return 1;
    }    
    
    public function load(ObjectManager $manager)
    {
    	/** USERS **/
    	$userAdmin = new User();
    	$userAdmin->setUsername('admin');
    	$userAdmin->setEmail('admin@kromahyundai.com');
    	$userAdmin->setPlainPassword('123456');
    	$userAdmin->setEnabled(true);
    	$userAdmin->setRoles(array('ROLE_ADMIN'));    	
    	$manager->persist($userAdmin);
    	 
    	$user1 = new User();
    	$user1->setUsername('cliente');
    	$user1->setEmail('cliente@kromahyundai.com');
    	$user1->setPlainPassword('123456');
    	$user1->setEnabled(true);
    	$user1->setRoles(array('ROLE_USER'));    	
    	$manager->persist($user1);
    	
    	/** BRAND RESOURCE CATEGORIES **/
    	$brCatTV = new BrandResourceCategory();
    	$brCatTV->setName('TV');
    	$manager->persist($brCatTV);
    	
    	$brCatPrint = new BrandResourceCategory();
    	$brCatPrint->setName('Print');
    	$manager->persist($brCatPrint);
    	
    	$brCatPhotos = new BrandResourceCategory();
    	$brCatPhotos->setName('Photos');
    	$manager->persist($brCatPhotos);
    	
    	/** BRANDS **/
    	$brand = new Brand();
    	$brand->setTitle($this->faker->word);
    	$brand->setDate(new \DateTime("now"));
    	$brand->setDescription($this->faker->text);
    	
    	$manager->persist($brand);
    	
    	/*for($i=1;$i<5;$i++)
    	{
    		$resource = new PostResource();
    		$resource->setPost($post);
    		$resource->setName($this->faker->word);
    		$resource->setType('image');
    		$resource->setResource('imagen'.$i);
    		
    		$manager->persist($resource);
    	}*/
    	
    	$manager->flush();
    }
}
