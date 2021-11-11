<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = [
            [
                'name' => 'Books',
                'children' => [
                    [
                        'name' => 'Comic Book',
                        'children' => [
                            ['name' => 'Marvel Comic Book'],
                            ['name' => 'DC Comic Book'],
                            ['name' => 'Action comics'],
                        ],
                    ],
                    [
                        'name' => 'Textbooks',
                        'children' => [
                            ['name' => 'Business'],
                            ['name' => 'Finance'],
                            ['name' => 'Computer Science'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Electronics',
                'children' => [
                    [
                        'name' => 'TV',
                        'children' => [
                            ['name' => 'LED'],
                            ['name' => 'Blu-ray'],
                        ],
                    ],
                    [
                        'name' => 'Mobile',
                        'children' => [
                            ['name' => 'Samsung'],
                            ['name' => 'iPhone'],
                            ['name' => 'Xiomi'],
                        ],
                    ],
                ],
            ],
        ];
        foreach($shops as $shop)
        {
            \App\Models\Category\Category::create($shop);
        }
    }
}
