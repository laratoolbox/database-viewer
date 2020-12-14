<?php

namespace LaraToolbox\DatabaseViewer\Commands;

use Illuminate\Console\Command;
use LaraToolbox\DatabaseViewer\DatabaseViewer;

class ShowTablesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows Tables';

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
                ->getTables()
                ->implode(PHP_EOL)
        );

        return 0;
    }
}
