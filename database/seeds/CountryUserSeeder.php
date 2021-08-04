<?php

use Illuminate\Database\Seeder;
use App\CountryUser;

class CountryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CountryUser::class, 50)->create();
    }
}
