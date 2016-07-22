<?php

namespace App\Console\Commands;

use App\Http\Requests\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class Import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Last JSON response for sync.';

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
        App::make('App\Http\Controllers\Api\ImportController')->index();
    }
}
