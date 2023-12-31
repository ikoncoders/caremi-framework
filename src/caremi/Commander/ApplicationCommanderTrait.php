<?php declare(strict_types=1);
namespace Caremi\Commander;

use Caremi\Utility\Yaml;
use Caremi\Utility\Stringify;

trait ApplicationCommanderTrait
{

    /**
     * Returns different variant of the controller name whether that be capitalize
     * pluralize or just a normal justify lower case controller name
     *
     * @param object $controller
     * @return string
     */
    public function getName(object $controller, string $type = 'lower'): string
    {
        if ($controller) {
            $name = $controller->thisRouteController();
            return match ($type) {
                'caps' => Stringify::capitalize($name),
                'pluralize' => Stringify::capitalize(Stringify::pluralize($name)),
                'lower' => Stringify::justify($name, 'strtolower')
            };
        }
    }

    /**
     * Return the query column value from the relevant controller settings row
     * if available. Not all table will have a query column
     *
     * @param object $controller
     * @return string|null
     */
    public function getStatusColumn(object $controller): string
    {
        $queryColumn = $controller->controllerRepository->getRepo()->findObjectBy(
            ['controller_name' => $this->getName($controller)],
            ['query']
        );
        if ($queryColumn) {
            return $queryColumn->query;
        }
    }

    /**
     * Dynamically get the queried value based on the query parameter. Using the 
     * status column return from the controller settings table for the relevant 
     * controller.
     *
     * @param object $controller
     * @return mixed
     */
    public function getStatusColumnFromQueryParams(object $controller): mixed
    {
        $queriedValue = $this->getStatusColumn($controller);
        if (isset($_GET[$queriedValue]) && $_GET[$queriedValue] !== '') {
            return $this->getName($controller, 'pluralize') . ' ' . Stringify::capitalize($_GET[$queriedValue]);
        } else {
            return $this->getName($controller, 'pluralize') . ' Listing';
        }
    }

    /**
     * Throw an exception if your commander inner routes doesn't match the controller
     * routes
     *
     * @param object $controller
     * @param array $innerRoutes
     * @return void
     */
    public function getHeaderBuildException(object $controller, array $innerRoutes): void
    {
        if (!in_array($controller->thisRouteAction(), $innerRoutes)) {
            throw new \Exception('This route is invalid. Because you did not assigned it to the INNER_ROUTES constant within the RoleCommander class.');
        }

    }

    /**
     * Return the a field name from the controller findOr404 object
     *
     * @param object $controller
     * @param string $fieldName
     * @return string|null
     */
    public function getHeaderBuildEdit(object $controller, string $fieldName): ?string
    {
        if ($controller->thisRouteID()) {
            return method_exists($controller, 'findOr404') ? $controller->findOr404()->$fieldName : 'Unknown Object';
        }
        return null;

    }

    /**
     * Get the specific yaml file which helps to render some text within the specified
     * html template.
     *
     * @param string $file
     * @return array
     */
    public function findYml(string $file): array
    {
        if (!file_exists(CONFIG_PATH . '/' . $file . '.yml')) {
            throw new \Exception($file . '.yml does not exist within your config directory. Your commander bar uses this to generate the manager links, plus more.');
        }
        if ($list = Yaml::file($file)) {
            return ($this->controller->thisRouteAction() === 'index') ? $list['index'] : $list['not_index'];
        }

    }
}