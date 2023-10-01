<?php declare(strict_types=1);

namespace Caremi\Inertia;

use Twig\Extension\AbstractExtension;
use Twig\Markup;
use Twig\TwigFunction;

class InertiaTwigExtension extends AbstractExtension
{

    public function getFunctions(): array
    {
        return [new TwigFunction('inertia', [$this, 'inertiaFunction'])];
    }

    public function inertiaFunction($page)
    {
        return new Markup('<div id="app" data-page="' . htmlspecialchars(json_encode($page)) . '"></div>', 'UTF-8');
    }

}