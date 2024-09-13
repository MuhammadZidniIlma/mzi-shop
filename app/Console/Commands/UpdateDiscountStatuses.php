<?php

namespace App\Console\Commands;

use App\Models\Discount;
use Illuminate\Console\Command;

class UpdateDiscountStatuses extends Command
{
    protected $signature = 'discounts:update-statuses';

    protected $description = 'Update discount statuses based on current date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $discounts = Discount::all();

        foreach ($discounts as $discount) {
            if ($discount->start_date <= now() && $discount->expiration_date >= now()) {
                $discount->status = 'active';
            } else {
                $discount->status = 'inactive';
            }
            $discount->save();
        }

        $this->info('Discount statuses updated successfully.');
    }
}
