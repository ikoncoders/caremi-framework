<?php declare(strict_types=1);

namespace Caremi\Migration;

interface MigrateInterface
{

    public function up(): string;
    public function down(): string;

}