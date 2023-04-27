<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(PostSeeder::class);
        // $this->call(CategorySeeder::class);
        \App\Models\Admin::create([
            'name' => 'admin',
            'email' => 'admin@dcreartdesign.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => \Hash::make('t@4agLiXVp5a')
        ]);
    }
}
