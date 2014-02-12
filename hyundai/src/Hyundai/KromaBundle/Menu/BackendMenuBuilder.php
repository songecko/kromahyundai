<?php
namespace Hyundai\KromaBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class BackendMenuBuilder
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
                'class' => 'nav'
            )
        ));

        $childOptions = array(
            'childrenAttributes' => array('class' => 'nav'),
            'labelAttributes'    => array('class' => 'nav-header')
        );

        $menu->addChild('post', array(
        		'route' => 'hyundai_kroma_backend_post_index',
        		'labelAttributes' => array('icon' => 'icon-facetime-video'),
        ))->setLabel("Post");
        
        return $menu;
    }
}