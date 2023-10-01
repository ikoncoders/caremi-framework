<?php declare(strict_types=1);
namespace Caremi\Router;

use Caremi\Router\Router;
use Caremi\Router\RouterInterface;

class RouterFactory
{

    /** 
     * @var Object - Router Object 
     * */
    protected Object $routerObject;
    /** 
     * @var string 
     * */
    protected ?string $url = null;

    /**
     * Router factory constructor
     *
     * @param string|null $url
     */
    public function __construct(?string $url = null)
    {
        if ($url !=null)
            $this->url = $url;
    }

    /**
     * Undocumented function
     *
     * @param string|null $routerString
     * @return void
     */
    public function create(?string $routerString = null) : RouterInterface
    {
        $this->routerObject = ($routerString !=null) ? new $routerString() : new Router();
        if (!$this->routerObject instanceof RouterInterface) {
            throw new \InvalidArgumentException();
        }

        return $this->routerObject;
    }

    /**
     * Undocumented function
     *
     * @param array $definedRoutes
     * @return void
     */
    public function buildRoutes(array $definedRoutes = [])
    {
        if (empty($definedRoutes)) {
            throw new \InvalidArgumentException('No routes defined');
        }
        $params = [];
        if (count($definedRoutes) > 0) {
            foreach ($definedRoutes as $route => $param) {
                if (isset($param['namespace']) && $param['namespace'] !='') {
                    $params = ['namespace' => $param['namespace']];
                } elseif (isset($param['controller']) && $param['controller'] !='') {
                    $params = ['controller' => $param['controller'], 'action' => $param['action']];
                }
                if (isset($route)) {
                    $this->routerObject->add($route, $params);
                }
    
            }    
        }
        /* 
        Add dynamic routes based on regular expression 
        */
        $this->routerObject->add('{controller}/{action}');
        /* 
        Dispatch the routes 
        */
        $this->routerObject->dispatch($this->url ? $this->url : $_SERVER['QUERY_STRING']);

    }

}