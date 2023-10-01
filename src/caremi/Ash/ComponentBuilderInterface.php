<?php declare(strict_types=1);
namespace Caremi\Ash;

interface ComponentBuilderInterface
{

    public function component(mixed $items): string;

}
