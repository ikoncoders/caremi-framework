<?php declare(strict_types=1);

namespace Caremi\Migration;

class Migrate
{

    public const NEED_MIGRATION = 'You\'ve not created any migration files yet!';
    public const CREATE_MIGRATION = 'Generating mirgation for...';
    public const END_MIGRATION = ' ... OK';

    public const FILES_ALTERING = ['Drop', 'Change', 'Add', 'Modify'];
    public const MIGRATE_DESTROY = 'Destroy';
    public const MIGRATE_UP = 'up';
    public const MIGRATE_DOWN = 'down';
    public const MIGRATE_CHANGE = 'change';


}