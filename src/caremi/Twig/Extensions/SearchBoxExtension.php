<?php declare(strict_types=1);

namespace Caremi\Twig\Extensions;

class SearchBoxExtension
{

    public function triggerSearchBox()
    {
        return '
            <a uk-tooltip="Search" uk-icon="icon:search; ratio:1.5" class="uk-navbar-toggle uk-text-muted" uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>
        ';
    }

    public function searchBox(string $filter = 's', string $placeholder = 'Search...'): string
    {
        return '
        <div class="nav-overlay uk-navbar-left uk-flex-1" hidden>
            <div class="uk-navbar-item uk-width-expand">
                <form class="uk-search uk-search-navbar uk-width-1-1">
                    <input class="uk-search-input" name="' . $filter . '" type="search" placeholder="' . $placeholder . '" autofocus>
                </form>
            </div>
            <a uk-tooltip="Close" uk-icon="icon:close; ratio:1.5" class="uk-navbar-toggle uk-text-muted" uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>
        </div>

        ';
    }
}
