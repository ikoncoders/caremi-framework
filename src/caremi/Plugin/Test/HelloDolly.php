<?php declare(strict_types=1);

namespace Caremi\Plugin\Test;

use Caremi\Plugin\PluginFactory;
use Caremi\Plugin\Test\MyPlugin;
use Caremi\Plugin\PluginManagerInterface;

class HelloDolly implements PluginManagerInterface
{

    /**
     * Name: HelloDolly;
     * URI: www.wordpress.org/plugins/hello-dolly/;
     * Description: This is not just a plugin it symbolizes the hope and enthusiasm of an entire; 
     * Author: Matt Mullenweg;
     * Homepage: www.ma.tt/;
     * Version: 1.0.0
     */
    public function pluginDeploy()
    {
        $factory = new PluginFactory();
        if ($factory) {
            $factory->create(HelloDolly::class);
            $factory->registerForServices(MyPlugin::class, ['error', 'clientRepository']);
            if ($factory->hasServices()) {
                return $factory->run();
            }
        }
    }
}
