<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->insert([
            ['name'=> 'Salary', 'category_id' => 1],
            ['name'=> 'Other', 'category_id' => 1],
            ['name'=> 'Food', 'category_id' => 2],
            ['name'=> 'Transport', 'category_id' => 2],
            ['name'=> 'Mobile connection', 'category_id' => 2],
            ['name'=> 'Internet', 'category_id' => 2],
            ['name'=> 'Entertainment', 'category_id' => 2],
            ['name'=> 'Other', 'category_id' => 2],
        ]);
    }
}
