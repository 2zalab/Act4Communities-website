<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajoute la colonne "translations" (version anglaise du contenu)
     * aux tables qui ne l'ont pas encore. projects et posts l'ont déjà.
     */
    private array $tables = ['projects', 'posts', 'resources', 'categories', 'resource_categories'];

    public function up()
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'translations')) {
                Schema::table($table, function (Blueprint $blueprint) {
                    $blueprint->json('translations')->nullable();
                });
            }
        }
    }

    public function down()
    {
        foreach (['resources', 'categories', 'resource_categories'] as $table) {
            if (Schema::hasColumn($table, 'translations')) {
                Schema::table($table, function (Blueprint $blueprint) {
                    $blueprint->dropColumn('translations');
                });
            }
        }
    }
};
