<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer\DataRelationship;

/**
 * Both tables can have only one record on each side of the relationship.
 * each primary key value relates to none or only one record in the related table
 */
interface DataRelationshipInterface
{
    /**
     * Undocumented function
     *
     * @param string $relationship
     * @return static
     */
    public function type(string $relationship): self;

    /**
     * Undocumented function
     *
     * @param string $tableLeft
     * @param string $tableRight
     * @return void
     */
    public function tables(string $tableLeft, string $tableRight): self;

    /**
     * Undocumented function
     *
     * @param string $tablePivot
     * @return void
     */
    public function pivot(string $tablePivot): self;

}