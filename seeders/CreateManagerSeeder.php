<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manager;

class CreateManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = Manager::create([
            'name' => 'Manager 1',
            'hospital' => 'Al-Sharq',
            'phone' => '0555555552',
            'email' => 'manager1@email.com',
            'password' => bcrypt('Asd@12345'),
            'role_id' => '2',
            ]);
    }
}
