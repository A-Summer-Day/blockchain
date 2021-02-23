<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->fill([
            "name" => "Ha Le",
            "email" => "ha.le1@mohawkcollege.ca"
        ]);
        $user->save();
    }
}
