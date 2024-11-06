<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visitor;

class CreateVisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $visitor = Visitor::create([
            'name' => 'Visitor1',
            'phone' => '0555555553',
            'email' => 'visitor1@email.com',
            'password' => bcrypt('Asd@12345'),
            'role_id' => '3',
            ]);
    }
}
