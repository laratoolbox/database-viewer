<?php

namespace LaraToolbox\DatabaseViewer\Commands;

use Illuminate\Console\Command;
use LaraToolbox\DatabaseViewer\DatabaseViewer;

class ShowTableColumnsForDocBlockCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:columns-doc {--table= : Table name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets columns for given table in dock block format';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
         * @property string $foo
         * @property int $bar
         */

        $result = (new DatabaseViewer())->getTableDefinition($this->option('table'))
            ->map(function ($column) {
                return sprintf(
                    ' * @property %s $%s',
                    $this->getType($column->Type),
                    $column->Field
                );
            })
            ->implode(PHP_EOL);

        $this->info(
            sprintf("/**\n%s\n */", $result)
        );

        return 0;
    }

    /**
     * Returns mysql data type into php data type
     *
     * @param string $databaseType
     * @return string
     */
    private function getType($databaseType)
    {
        if (strpos($databaseType, 'timestamp') !== false) {
            return 'string|\Illuminate\Support\Carbon';
        }

        if (strpos($databaseType, 'date') !== false) {
            return 'string|\Illuminate\Support\Carbon';
        }

        if (strpos($databaseType, 'char') !== false) {
            return 'string';
        }

        if (strpos($databaseType, 'int') !== false) {
            return 'int';
        }

        return $databaseType;
    }
}
