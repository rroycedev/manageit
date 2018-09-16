<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes a view';

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
     * @return mixed
     */
    public function handle()
    {
        $viewName = $this->ask('View Name:');

        $this->info("View is $viewName");
    }
}
