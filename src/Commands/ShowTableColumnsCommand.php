<?php

namespace LaraToolbox\DatabaseViewer\Commands;

use Illuminate\Console\Command;
use LaraToolbox\DatabaseViewer\DatabaseViewer;

class ShowTableColumnsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:columns {--table= : Table name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets columns for given table';

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
        $this->info(
            (new DatabaseViewer())
                ->getColumns(
                    $this->option('table')
                )
                ->implode(PHP_EOL)
        );

        return 0;
    }
}
