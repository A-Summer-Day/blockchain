<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Wallet;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wallet_list = [
			["user_id" => 1, "api_key" => "d691-d261-17e2-f3b5", 'minimum_amount' => 0.0002],
			["user_id" => 1, "api_key" => "f987-9200-b80f-5e2f", 'minimum_amount' => 0.00002],
			["user_id" => 1, "api_key" => "bd8e-4a98-6d26-dfd0", 'minimum_amount' => 2]
        ];
        foreach($wallet_list as $wallet_item) {
            $wallet = new Wallet();
            $wallet->fill($wallet_item);
            $wallet->save();
        }
    }
}
