<?php declare(strict_types=1);
namespace Caremi\Base\Domain;

interface DomainActionLogicInterface
{

    /**
     * Undocumented function
     *
     * @param Object $controller
     * @param string $entityObject
     * @param string $eventDispatcher
     * @param string|null $objectSchema
     * @param string $method
     * @param string $class
     * @param array $additionalContext
     * @return self
     */
    public function execute(
        Object $controller,
        string|null $entityObject = null,
        string|null $eventDispatcher = null,
        string|null $objectSchema = null,
        string $method,
        array $rules = [],
        array $additionalContext = []
    ): self;
    
    /**
     * Undocumented function
     *
     * @param string|null $filename
     * @param integer $extension
     * @return self
     */
    public function render(string|null $filename = null, int $extension = 2): self;

    /**
     * Undocumented function
     *
     * @param array $context
     * @return self
     */
    public function with(array $context = []): self;
    
    /**
     * Undocumented function
     *
     * @param Object $formRendering
     * @param string|null $formAction
     * @param mixed $data
     * @return self
     */
    public function form(Object $formRendering, string|null $formAction = null, mixed $data = null): self;

    /**
     * Undocumented function
     *
     * @param array $tableParams
     * @param object|null $column
     * @param object|null $repository
     * @param array $tableData
     * @return self
     */
    public function table(array $tableParams = [], object|null $column = null, object|null $repository = null, array $tableData = []): self;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function end(string|null $type = null): void;
}
