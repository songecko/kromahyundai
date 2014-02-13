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
        	new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
        	new FOS\RestBundle\FOSRestBundle(),
        	new FOS\UserBundle\FOSUserBundle(),
        	new JMS\SerializerBundle\JMSSerializerBundle($this),
        	new Sylius\Bundle\ResourceBundle\SyliusResourceBundle(),
        	new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
        	new RaulFraile\Bundle\LadybugBundle\RaulFraileLadybugBundle(),
        	new Knp\Bundle\MenuBundle\KnpMenuBundle(),
        	new Sonata\CoreBundle\SonataCoreBundle(),
        	new Sonata\MediaBundle\SonataMediaBundle(),
        	new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
        	new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
            new Hyundai\KromaBundle\HyundaiKromaBundle(),
        	new Gecko\BackendBundle\GeckoBackendBundle(),
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
