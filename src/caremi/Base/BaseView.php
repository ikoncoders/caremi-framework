<?php declare(strict_types=1);
namespace Caremi\Base;

use Caremi\Utility\Yaml;
use Caremi\Ash\Error\LoaderError;
use Caremi\Ash\TemplateEnvironment;
use Caremi\Ash\Exception\FileNotFoundException;

class BaseView
{

    /**
     * Render a view template using the framework native template engine
     *
     * @param string $template
     * @param array $context
     * @return void
     * @throws LoaderError
     * @throws FileNotFoundException
     */
    public function ashRender(string $template, array $context = [])
    {
        echo $this->templateRender($template, $context);
    }

    /**
     * Get the contents of a view template using the native framework template
     * engine.
     *
     * @param string $template
     * @param array $context
     * @return mixed
     * @throws LoaderError
     */
    public function templateRender(string $template, array $context = [])
    {
        static $ash = null;
        if ($ash === null) {
            $ash = new TemplateEnvironment(Yaml::file('template'), 'templates', TEMPLATE_PATH);
        }

        return $ash->view($template, $context);
    }

}
