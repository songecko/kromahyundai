<?php
namespace Hyundai\KromaBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class FrontendMenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'sidebar-menu'
            )
        ));

        $menu->addChild('dashboard', array(
        		'route' => 'hyundai_kroma_dashboard',
        		'labelAttributes' => array('icon' => 'fa-dashboard'),
        ))->setLabel("Dashboard");
        
        $menu->addChild('post', array(
        		'route' => 'hyundai_kroma_posts_index',
        		'labelAttributes' => array('icon' => 'fa-th'),
        ))->setLabel("Materiales");
        
        return $menu;
    }
}