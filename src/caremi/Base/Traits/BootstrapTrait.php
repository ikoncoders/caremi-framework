<?php declare(strict_types=1);
namespace Caremi\Base\Traits;

trait BootstrapTrait
{

    /**
     * DSefault settings uses a common basic structur which defines the parameters
     * for components within this framework which exposes configurable 
     * parameters. This little snippet helps us to load the default settings which 
     * can be override by the use app config yaml files
     *
     * @param array $config
     * @return mixed
     */
    private function getDefaultSettings(array $config): mixed
    {
        if (count($config) > 0) {
            if (array_key_exists('drivers', $config)) {
                $sess  = $config['drivers']['native_storage'];
                if ($sess['default'] === true) {
                    return $sess['class'];
                }
            }
        }
    }


}
