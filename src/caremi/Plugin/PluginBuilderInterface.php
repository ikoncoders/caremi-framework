<?php declare(strict_types=1);

namespace Caremi\Plugin;

interface PluginBuilderInterface
{

    /**
     * Execute the plugin
     *
     * @return string
     */
    public function pluginProcessor();


}