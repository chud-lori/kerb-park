<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class BaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bays')->insert([
            'bay_code' => Str::random(5),
            'status' => 'occupied'
        ]);

        DB::table('bays')->insert([
            'bay_code' => Str::random(5),
            'status' => 'available'
        ]);

        DB::table('bays')->insert([
            'bay_code' => Str::random(5),
            'status' => 'available'
        ]);
    }
}
