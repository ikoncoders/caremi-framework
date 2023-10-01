<?php declare(strict_types=1);
namespace Caremi\Themes;

interface ThemeBuilderInterface
{

    public static function theme(string $key): mixed;

}