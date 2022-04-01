<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('surveys')->insert(
            [
                [
                    'title' => 'Penelitian Gadget',
                    'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.     Pariatur officia omnis harum inventore voluptas, consectetur assumenda magnam nesciunt laudantium similique? Voluptates voluptas sed tempore commodi cumque illum asperiores omnis molestias?',
                    'link' => 'https://www.udemy.com/',
                    'user_id' => 1
                ],
                [
                    'title' => 'Penelitian Java',
                    'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.     Pariatur officia omnis harum inventore voluptas, consectetur assumenda magnam nesciunt laudantium similique? Voluptates voluptas sed tempore commodi cumque illum asperiores omnis molestias?',
                    'link' => 'https://www.google.com/',
                    'user_id' => 1
                ],
                [
                    'title' => 'Penelitian Rumah Batak',
                    'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.     Pariatur officia omnis harum inventore voluptas, consectetur assumenda magnam nesciunt laudantium similique? Voluptates voluptas sed tempore commodi cumque illum asperiores omnis molestias?',
                    'link' => 'https://github.com/',
                    'user_id' => 2
                ]
            ]
        );
        
    }
}
