<?php declare(strict_types=1);

namespace Caremi\Logger;

use Caremi\Logger\LoggerInterface;

/**
 * Describes a logger-aware instance.
 */
interface LoggerAwareInterface
{
    /**
     * Sets a logger instance on the object.
     *
     * @param LoggerInterface $logger
     * @return void
     */
    public function setLogger(LoggerInterface $logger): void;
}