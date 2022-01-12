<?php

namespace Credpal\CPInvest\Commands;

use Credpal\CPInvest\Models\Tenure;
use Credpal\CPInvest\Services\InvestService;
use Illuminate\Console\Command;

class SeedDataToTenureTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cpinvest:seed_tenures';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed tenure data from credpal invest to tenures tab;e';

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
        $tenureData = InvestService::getInvestmentTenures();

        foreach ($tenureData["data"] as $tenure) {
            Tenure::updateOrCreate([
                'id' => $tenure['id']
            ], [
                'days' => $tenure['days'],
                'percentage' => $tenure['percentage'],
                'deactivated' => $tenure['deactivated'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return 0;
    }
}
