<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;

        $categoryArray[$i]['name']       = 'Pre Purchase Query';
        $categoryArray[$i]['created_at'] = date('Y-m-d H:i:s');
        $categoryArray[$i]['updated_at'] = date('Y-m-d H:i:s');

        $i++;
        $categoryArray[$i]['name']       = 'New Installation';
        $categoryArray[$i]['created_at'] = date('Y-m-d H:i:s');
        $categoryArray[$i]['updated_at'] = date('Y-m-d H:i:s');

        $i++;
        $categoryArray[$i]['name']       = 'Support';
        $categoryArray[$i]['created_at'] = date('Y-m-d H:i:s');
        $categoryArray[$i]['updated_at'] = date('Y-m-d H:i:s');

        $i++;
        $categoryArray[$i]['name']       = 'Bug & Fixing';
        $categoryArray[$i]['created_at'] = date('Y-m-d H:i:s');
        $categoryArray[$i]['updated_at'] = date('Y-m-d H:i:s');

        $i++;
        $categoryArray[$i]['name']       = 'Feature Query';
        $categoryArray[$i]['created_at'] = date('Y-m-d H:i:s');
        $categoryArray[$i]['updated_at'] = date('Y-m-d H:i:s');

        if (!blank($categoryArray)) {
            Category::insert($categoryArray);
        }
    }
}
