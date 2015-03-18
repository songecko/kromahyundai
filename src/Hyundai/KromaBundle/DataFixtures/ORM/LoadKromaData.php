<?php

namespace Hyundai\KromaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Faker\Factory as FakerFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Finder\Finder;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Hyundai\KromaBundle\Entity\User;
use Hyundai\KromaBundle\Entity\Brand;
use Hyundai\KromaBundle\Entity\BrandResourceCategory;
use Hyundai\KromaBundle\Entity\BrandResource;
use Hyundai\KromaBundle\Entity\BrandResourceFile;

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
    	/*$brCatTV = new BrandResourceCategory();
    	$brCatTV->setName('TV');
    	$manager->persist($brCatTV);
    	
    	$brCatPrint = new BrandResourceCategory();
    	$brCatPrint->setName('Print');
    	$manager->persist($brCatPrint);
    	
    	$brCatPhotos = new BrandResourceCategory();
    	$brCatPhotos->setName('Photos');
    	$manager->persist($brCatPhotos);*/
    	
    	/** BRANDS **/
    	/*$brand = new Brand();
    	$brand->setTitle($this->faker->word);
    	$brand->setDate(new \DateTime("now"));
    	$brand->setDescription($this->faker->text);
    	
    	$manager->persist($brand);*/
    	
    	/** BRAND RESOURCES **/
    	$root = new BrandResource();
    	$root->setName("Root");
    	$manager->persist($root);
    	
    	$productPictures = new BrandResource();
    	//$brResCatTV->setCategory($brCatTV);
    	//$brResCatTV->setBrand($brand);
    	$productPictures->setName("Product Pictures");
    	$productPictures->setParent($root);
    	$manager->persist($productPictures);
    	
    	$santaFe = new BrandResource();
    	//$brResCatPrint->setCategory($brCatPrint);
    	//$brResCatPrint->setBrand($brand);
    	$santaFe->setName("Santa Fe");
    	$santaFe->setParent($productPictures);    	
    	$manager->persist($santaFe);
    	
    	$santaFeBackground = new BrandResource();
    	$santaFeBackground->setName("Background");
    	$santaFeBackground->setParent($santaFe);
    	$manager->persist($santaFeBackground);
    	
    	$santaFeWithoutBack = new BrandResource();
    	$santaFeWithoutBack->setName("Without Background");
    	$santaFeWithoutBack->setParent($santaFe);
    	$manager->persist($santaFeWithoutBack);
    	
    	/** BRAND RESOURCE FILES **/
    	$path = $this->container->getParameter('kernel.root_dir').'/../web/fixtures/images/prueba.jpg';
    	$file = new File($path);
    	
    	$brResFileCatTV = new BrandResourceFile();
    	$brResFileCatTV->setBrandResource($santaFeBackground);
    	$brResFileCatTV->setResource($file);
    	$brResFileCatTV->setName('prueba.jpg');
    	$manager->persist($brResFileCatTV);
    	
    	$brResFileCatPrint = new BrandResourceFile();
    	$brResFileCatPrint->setBrandResource($santaFeWithoutBack);
    	$brResFileCatPrint->setResource($file);
    	$brResFileCatPrint->setName('prueba.jpg');
    	$manager->persist($brResFileCatPrint);
    	
    	$brResFileCatPhotos = new BrandResourceFile();
    	$brResFileCatPhotos->setBrandResource($santaFe);
    	$brResFileCatPhotos->setResource($file);
    	$brResFileCatPhotos->setName('prueba.jpg');
    	$manager->persist($brResFileCatPhotos);
    	
    	$manager->flush();
    }
}
