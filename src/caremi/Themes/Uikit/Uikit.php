<?php declare(strict_types=1);
namespace Caremi\Themes\Uikit;

use Caremi\Themes\ThemeBuilderInterface;

class Uikit implements ThemeBuilderInterface
{

    public static function theme(string $key): mixed
    {
        $theme = [
            'table_class' => [
                'uk-table',
                'uk-table-middle',
                'uk-table-hover',
                'uk-table-striped',
                'uk-table-responsive',
                'uk-table-condensed'
            ],
            'table_reset_link' => 'uk-link-reset',
            'paging' => [
                'disable' => 'uk-disabled',
                'active' => 'uk-active',
                'paging_info' => 'info',
                'pagination' => 'uk-pagination'
            ]
        ];

        return isset($theme[$key]) ? $theme[$key] : '';
    }
}
