<?php declare(strict_types=1);

namespace Caremi\StringCollection;

use Caremi\StringCollection\StringCollectionInterface;

class StringCollection implements StringCollectionInterface
{

    /**
     * Undocumented function
     *
     * @param string $str
     */
    public function __construct(string $str)
    {
        $this->str = (string)$str;
    }

    /**
     * Simple return the raw string
     *
     * @return string
     */
    public function raw(): string
    {
        return $this->str;
    }
}
