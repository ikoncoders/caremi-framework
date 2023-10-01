<?php declare(strict_types=1);

namespace Caremi\Migration;

interface MigrationInterface
{

    public function createMigrationTable(): void;
    public function saveMigration(array $fields): bool;
    public function getMigrations(array $conditions = []): array|null;
    public function createMigrationFromSchema();
    public function locateMigrationFiles(): array;
    public function migrate(string|null $direction = 'up'): void;

}