<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'start_session' => '2021-10-15 21:00:00',
            'payment' => 'unpaid',
            'car_id' => 1,
            'bay_id' => 1,
        ]);
    }
}
