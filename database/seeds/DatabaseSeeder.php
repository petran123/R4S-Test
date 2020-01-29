<?php

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
        factory('App\Tenant', 20)->create()->each(function ($tenant) {
            $tenant->save();
        });
    }
}
