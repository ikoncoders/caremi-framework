<?php declare(strict_types=1);

namespace Caremi\Migration;

interface MigrateChangeInterface
{

    public function change(): string;

}