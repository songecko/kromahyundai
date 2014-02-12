<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
<<<<<<< HEAD
        	new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
        	new FOS\RestBundle\FOSRestBundle(),
        	new JMS\SerializerBundle\JMSSerializerBundle($this),
        	new Sylius\Bundle\ResourceBundle\SyliusResourceBundle(),
        	new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
        	new RaulFraile\Bundle\LadybugBundle\RaulFraileLadybugBundle(),
        	new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Hyundai\KromaBundle\HyundaiKromaBundle(),
        	new Gecko\BackendBundle\GeckoBackendBundle(),
=======
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Hyundai\KromaBundle\HyundaiKromaBundle(),
>>>>>>> cf493ad28f20edb6cc5d10a6cc8a1fcf51d620b2
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
