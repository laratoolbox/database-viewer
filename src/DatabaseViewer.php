<?php

namespace LaraToolbox\DatabaseViewer;

class DatabaseViewer
{
    /**
     * Gets table list
     *
     * @return \Illuminate\Support\Collection
     */
    public function getTables()
    {
        return collect(\DB::select('SHOW TABLES'))
            ->map(function ($table) {
                return current($table);
            });
    }

    /**
     * Get table definition
     *
     * @param String $table
     * @return \Illuminate\Support\Collection
     */
    public function getTableDefinition($table)
    {
        /**
         * [{
         *   +"Field": "id",
         *  +"Type": "bigint unsigned",
         *   +"Null": "NO",
         *   +"Key": "PRI",
         *   +"Default": null,
         *   +"Extra": "auto_increment",
         *   }]
         */
        return collect(\DB::select(sprintf('DESCRIBE %s', $table)));
    }

    /**
     * Get column names
     *
     * @param string $table
     * @return \Illuminate\Support\Collection
     */
    public function getColumns($table)
    {
        return $this->getTableDefinition($table)
            ->map(function ($item) {
                return $item->Field;
            });
    }
}
