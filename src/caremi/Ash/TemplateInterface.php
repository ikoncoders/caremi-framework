<?php declare (strict_types = 1);
namespace Caremi\Ash;

interface TemplateInterface
{

    /**
     * Undocumented function
     *
     * @param string $file
     * @param array $context
     * @return void
     */
    public function view(string $file, array $context = []);

}
