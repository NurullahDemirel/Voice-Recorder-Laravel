<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $fake)
    {
        for ($i=1;$i<101;$i++){
            DB::table('examples')->insert([
               'user_id'=>$i,
               'name'=>$fake->name
            ]);
        }
    }
}
