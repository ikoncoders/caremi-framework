<?php declare(strict_types=1);

namespace caremi\Http\Event;

final class BaseEvents
{

    const REQUEST = 'base.request';
    const RESPONSE = 'base.response';
    const EXCEPTION = 'base.exception';
    const CONTROLLER = 'base.controller';
    const VIEW = 'base.view';

}
