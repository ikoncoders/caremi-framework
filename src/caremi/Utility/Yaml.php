<?php declare(strict_types=1);

namespace Caremi\Utility;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;
use Exception;

class Yaml
{

    /**
     * Check whether the specified yaml configuration file exists within
     * the specified directory else throw an exception
     *
     * @param string $filename
     * @return boolean
     * @throws Exception
     */
    private function isFileExists(string $filename)
    {
        if (!file_exists($filename))
            throw new \Exception($filename . ' does not exists');
    }

    /**
     * Load a yaml configuration
     *
     * @param string $yamlFile
     * @return void
     * @throws ParseException
     */
    public function getYaml(string $yamlFile)
    {
        if (defined('CONFIG_PATH')) {
            foreach (glob(CONFIG_PATH . DIRECTORY_SEPARATOR . '*.yml') as $file) {
                $this->isFileExists($file);
                $parts = parse_url($file);
                $path = $parts['path'];
                if (strpos($path, $yamlFile) !== false) {
                    return SymfonyYaml::parseFile($file);
                }
            }
    
        }

            
    }

    /**
     * Load a yaml configuration into the yaml parser
     *
     * @param string $yamlFile
     * @return void
     */
    public static function file(string $yamlFile) : array
    {
        return (array)(new Yaml())->getYaml($yamlFile);
    }

}
