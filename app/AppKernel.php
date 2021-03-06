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
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            # secure
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),  
            new JMS\TranslationBundle\JMSTranslationBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),

            # doctrine
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),        		

            # route
            new BeSimple\I18nRoutingBundle\BeSimpleI18nRoutingBundle(),        		

            # sonata
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\NotificationBundle\SonataNotificationBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),        		
            new Sonata\BlockBundle\SonataBlockBundle(),        		
            new Sonata\MediaBundle\SonataMediaBundle(),    
            new Sonata\ClassificationBundle\SonataClassificationBundle(), 

            # tools
            new FOS\UserBundle\FOSUserBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Nelmio\JsLoggerBundle\NelmioJsLoggerBundle(),
            new Lexik\Bundle\MaintenanceBundle\LexikMaintenanceBundle(),

            # Sfynx
            new Sfynx\CaptchaBundle\SfynxCaptchaBundle(),
            new Sfynx\AclManagerBundle\SfynxAclManagerBundle(),
            new Sfynx\DatabaseBundle\SfynxDatabaseBundle(),
            new Sfynx\WsBundle\SfynxWsBundle(),
            new Sfynx\WsseBundle\SfynxWsseBundle(),
            new Sfynx\ApiBundle\SfynxApiBundle(),
            new Sfynx\SpecificationBundle\SfynxSpecificationBundle(),            
            new Sfynx\CacheBundle\SfynxCacheBundle(),
            new Sfynx\ToolBundle\SfynxToolBundle(),
            new Sfynx\CrawlerBundle\SfynxCrawlerBundle(),            
            new Sfynx\MigrationBundle\SfynxMigrationBundle(),
            new Sfynx\TriggerBundle\SfynxTriggerBundle(),
            new Sfynx\CoreBundle\SfynxCoreBundle(),
            new Sfynx\TranslatorBundle\SfynxTranslatorBundle(),
            new Sfynx\BrowserBundle\SfynxBrowserBundle(),
            new Sfynx\EncryptBundle\SfynxEncryptBundle(),
            new Sfynx\PositionBundle\SfynxPositionBundle(),
            new Sfynx\AdminBundle\SfynxAdminBundle(),
            new Sfynx\MediaBundle\SfynxMediaBundle(),
            new Sfynx\ClassificationBundle\SfynxClassificationBundle(),                
            new Sfynx\TemplateBundle\SfynxTemplateBundle(),
            new Sfynx\SmoothnessBundle\SfynxSmoothnessBundle(),
            new PiApp\GedmoBundle\PiAppGedmoBundle(),
            new Cmf\ContentBundle\CmfContentBundle(),
            new Sfynx\AuthBundle\SfynxAuthBundle(),
            new Sfynx\CmfBundle\SfynxCmfBundle(),

            #override Sfynx bundles
            new OrApp\OrCmfBundle\OrAppOrCmfBundle(),
            new OrApp\OrGedmoBundle\OrAppOrGedmoBundle(),
            new OrApp\OrTemplateBundle\OrAppOrTemplateBundle(),
        );
            
        if (in_array($this->getEnvironment(), array('dev', 'test', 'unit', 'acceptation'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();            	
            //$bundles[] = new So\LogboardBundle\LogboardBundle();
            $bundles[] = new Lexik\Bundle\MonologBrowserBundle\LexikMonologBrowserBundle();    
            $bundles[] = new Bazinga\Bundle\FakerBundle\BazingaFakerBundle();
        }
        
        if ('acceptation' === $this->getEnvironment()) {
            $bundles[]  = new Sfynx\BehatBundle\SfynxBehatBundle();
            $bundles[]  = new Behat\MinkBundle\MinkBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');        

        $envParameters = $this->getEnvParameters();
        $loader->load(function($container) use($envParameters) {
            $container->getParameterBag()->add($envParameters);
        });        
    }
    
    /**
     * For example to manual create scope "request" in CLI you may overload initializeContainer kernel metod.
     *
     * @see \Symfony\Component\HttpKernel\Kernel::initializeContainer()
     */
    protected function initializeContainer() {
    	parent::initializeContainer();
    	if (PHP_SAPI == 'cli') {
            $this->getContainer()->enterScope('request');
            $this->getContainer()->set('request', new \Symfony\Component\HttpFoundation\Request(), 'request');
    	}
    }    
}
