<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class ElasticIndexProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:index-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index product to Elastic Search';

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
        Product::deleteIndex();
        Product::reindex();
        return 0;
    }
}
