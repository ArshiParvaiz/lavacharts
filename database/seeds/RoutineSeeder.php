<?php

use Illuminate\Database\Seeder;
use App\Routine;

class RoutineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Routine = Routine::create([
            'work' => 'Sleep', 
            'hours'=>  7,
        ]);
    }
}
