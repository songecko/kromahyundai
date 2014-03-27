<?php
namespace Hyundai\KromaBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

class FrontendMenuBuilder
{
    private $factory;
    protected $securityContext;
    
    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, SecurityContextInterface $securityContext)
    {
        $this->factory = $factory;
        $this->securityContext = $securityContext;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'sidebar-menu'
            )
        ));

        /*$menu->addChild('dashboard', array(
        		'route' => 'hyundai_kroma_dashboard',
        		'labelAttributes' => array('icon' => 'fa-dashboard'),
        ))->setLabel("Dashboard");*/
        
        if($this->securityContext->isGranted('ROLE_ADMIN'))
        {
	        $menu->addChild('brand', array(
	        		'route' => 'hyundai_kroma_brand_index',
	        		'labelAttributes' => array('icon' => 'fa-th'),
	        ))->setLabel("Productos");
	        
	        $menu->addChild('category', array(
	        		'route' => 'hyundai_kroma_brandresourcecategory_index',
	        		'labelAttributes' => array('icon' => 'fa-folder'),
	        ))->setLabel("Categorías");
	        
	                
	        $menu->addChild('user', array(
	        		'route' => 'hyundai_kroma_user_index',
	        		'labelAttributes' => array('icon' => 'fa-user'),
	        ))->setLabel("Usuarios");
        }else if($this->securityContext->isGranted('ROLE_USER'))
    	{
    		$menu->addChild('brand_user', array(
    				'route' => 'hyundai_kroma_branduser_index',
    				'labelAttributes' => array('icon' => 'fa-th'),
    		))->setLabel("Productos");
    	}
    	
        return $menu;
    }
}