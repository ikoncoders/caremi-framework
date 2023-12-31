<?php declare(strict_types=1);
namespace Caremi\Commander;

interface ApplicationCommanderInterface
{

    /**
     * Returns different variant of the controller name whether that be capitalize
     * pluralize or just a normal justify lower case controller name
     *
     * @param object $controller
     * @return string
     */
    public function getName(object $controller, string $type = 'lower'): string;

    /**
     * Return the query column value from the relevant controller settings row
     * if available. Not all table will have a query column
     *
     * @param object $controller
     * @return string|null
     */
    public function getStatusColumn(object $controller): ?string;

    /**
     * Dynamically get the queried value based on the query parameter. Using the 
     * status column return from the controller settings table for the relevant 
     * controller.
     *
     * @param object $controller
     * @return mixed
     */
    public function getStatusColumnFromQueryParams(object $controller): mixed;

    /**
     * Return the build for the commander bar
     *
     * @param object $controller
     * @return string
     */
    public function getHeaderBuild(object $controller): string;

}