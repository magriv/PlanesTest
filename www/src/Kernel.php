<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): array
    {
        $bundles = [
            new FrameworkBundle(),
            new TwigBundle(),
        ];

        if ($this->getEnvironment() === 'dev') {
            $bundles[] = new WebProfilerBundle();
        }

        return $bundles;
    }

    protected function configureContainer(ContainerConfigurator $c): void
    {
        $c->import(__DIR__.'/../config/framework.yaml');
        if ($this->getEnvironment() === 'test') {
            $c->import(__DIR__.'/../config/test/framework.yaml');
        }

        $c->import(__DIR__.'/../config/services.yaml');

        // configure WebProfilerBundle only if the bundle is enabled
        if (isset($this->bundles['WebProfilerBundle'])) {
            $c->extension('web_profiler', [
                'toolbar' => true,
                'intercept_redirects' => false,
            ]);
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        // import the WebProfilerRoutes, only if the bundle is enabled
        if (isset($this->bundles['WebProfilerBundle'])) {
            $routes->import('@WebProfilerBundle/Resources/config/routing/wdt.xml')->prefix('/_wdt');
            $routes->import('@WebProfilerBundle/Resources/config/routing/profiler.xml')->prefix('/_profiler');
        }

        // load the annotation routes
        $routes->import(__DIR__.'/Controller/', 'annotation');
    }

    public function getCacheDir(): string
    {
        return __DIR__.'/../var/cache/'.$this->getEnvironment();
    }

    public function getLogDir(): string
    {
        return __DIR__.'/../var/log';
    }
}
