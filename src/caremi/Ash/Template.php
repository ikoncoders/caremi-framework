<?php declare (strict_types = 1);
namespace Caremi\Ash;

use Caremi\Ash\AbstractTemplate;

class Template extends AbstractTemplate
{

    /** @var TemplateEnvironment */
    protected TemplateEnvironment $templateEnvironment;

    /**
     * Main class constructor
     *
     * @param array $templateEnvironment
     * @return void
     */
    public function __construct(TemplateEnvironment $templateEnvironment)
    {
        $this->templateEnvironment = $templateEnvironment;
        parent::__construct($templateEnvironment);
    }

    /**
     * Display the template
     *
     * @param string $file
     * @param array $context
     * @return Response
     */
    public function view(string $file, array $context = [])
    {
        $fileCache = $this->cache(TEMPLATES . $file);
        extract(array_merge($context, $context), EXTR_SKIP);
        require $fileCache;
    }

}
